import { NodeEditor, ClassicPreset } from 'rete';
import { AreaPlugin, AreaExtensions } from 'rete-area-plugin';
import { ConnectionPlugin, Presets as ConnectionPresets } from 'rete-connection-plugin';
import { VuePlugin, Presets as VuePresets } from 'rete-vue-plugin';
import { AutoArrangePlugin, Presets as ArrangePresets } from 'rete-auto-arrange-plugin';

// Define schema state
const schemaState = {
    models: [],
    selectedModel: null,
};

// Socket for relations
const relationSocket = new ClassicPreset.Socket('relation');

/**
 * Fields Display Control - shows fields inside the node
 */
class FieldsControl extends ClassicPreset.Control {
    constructor(fields) {
        super();
        this.fields = fields;
    }
}

/**
 * Model Node - represents a database model/table
 */
class ModelNode extends ClassicPreset.Node {
    constructor(data = {}) {
        const modelName = data.modelName || 'NewModel';
        super(modelName);
        
        this.modelName = modelName;
        this.tableName = data.tableName || this.modelName.toLowerCase() + 's';
        this.fields = data.fields || [];
        this.relations = data.relations || [];
        
        // Add fields display control
        this.fieldsControl = new FieldsControl(this.fields);
        this.addControl('fields', this.fieldsControl);
        
        // Add output socket for relations
        this.addOutput('relations', new ClassicPreset.Output(relationSocket, 'Relations'));
        // Add input socket for relations
        this.addInput('relations', new ClassicPreset.Input(relationSocket, 'Relations'));
    }
    
    updateLabel(newLabel) {
        this.label = newLabel;
    }
    
    updateFieldsDisplay() {
        // Update the control with new fields data
        if (this.fieldsControl) {
            this.fieldsControl.fields = this.fields;
        }
    }
    
    getData() {
        return {
            id: this.id,
            modelName: this.modelName,
            tableName: this.tableName,
            fields: this.fields,
            relations: this.relations,
        };
    }
    
    addField(field) {
        this.fields.push(field);
    }
    
    removeField(index) {
        this.fields.splice(index, 1);
    }
    
    updateField(index, field) {
        this.fields[index] = field;
    }
}

/**
 * Relation Connection - represents model relations
 */
class RelationConnection extends ClassicPreset.Connection {
    constructor(source, sourceOutput, target, targetInput, relationType = 'hasMany') {
        super(source, sourceOutput, target, targetInput);
        this.relationType = relationType;
    }
}

/**
 * Schema Editor - main controller
 */
class SchemaEditor {
    constructor(container) {
        this.container = container;
        this.editor = null;
        this.area = null;
        this.selectedNode = null;
        this.nodeCounter = 0;
    }
    
    async initialize() {
        // Create editor instance
        this.editor = new NodeEditor();
        this.area = new AreaPlugin(this.container);
        const connection = new ConnectionPlugin();
        const render = new VuePlugin();
        
        // Setup selectable nodes
        AreaExtensions.selectableNodes(this.area, AreaExtensions.selector(), {
            accumulating: AreaExtensions.accumulateOnCtrl()
        });
        
        // Setup rendering with custom control for fields
        render.addPreset(VuePresets.classic.setup({
            customize: {
                control(data) {
                    if (data.payload instanceof FieldsControl) {
                        return {
                            component: {
                                template: `
                                    <div class="fields-display">
                                        <div v-if="fields.length === 0" class="no-fields">No fields</div>
                                        <div v-for="(field, index) in fields" :key="index" class="field-row">
                                            <span class="field-name">{{ field.name }}</span>
                                            <span class="field-type">: {{ field.type }}</span>
                                        </div>
                                    </div>
                                `,
                                props: ['data'],
                                computed: {
                                    fields() {
                                        return this.data.payload.fields || [];
                                    }
                                }
                            }
                        };
                    }
                }
            }
        }));
        
        // Connect plugins
        this.editor.use(this.area);
        this.area.use(connection);
        this.area.use(render);
        
        connection.addPreset(ConnectionPresets.classic.setup());
        
        // Listen for node selection
        this.area.addPipe((context) => {
            if (context.type === 'nodepicked') {
                this.selectNode(context.data.id);
            }
            return context;
        });
        
        // Listen for connection changes
        this.editor.addPipe((context) => {
            if (context.type === 'connectioncreated' || context.type === 'connectionremoved') {
                setTimeout(() => this.updateSchema(), 10);
            }
            return context;
        });
        
        // Listen for node removal
        this.editor.addPipe((context) => {
            if (context.type === 'noderemoved') {
                setTimeout(() => {
                    this.updateSchema();
                    if (this.selectedNode === context.data.id) {
                        this.clearSelection();
                    }
                }, 10);
            }
            return context;
        });
        
        // Setup UI event listeners
        this.setupEventListeners();
        
        // Initial schema update
        this.updateSchema();
    }
    
    setupEventListeners() {
        // Add Model button
        const addModelBtn = document.getElementById('add-model-btn');
        if (addModelBtn) {
            addModelBtn.addEventListener('click', () => this.addModel());
        }
    }
    
    async addModel(data = {}) {
        const modelName = data.modelName || `Model${++this.nodeCounter}`;
        const tableName = data.tableName || modelName.toLowerCase() + 's';
        
        const modelNode = new ModelNode({
            modelName,
            tableName,
            fields: data.fields || [
                { name: 'id', type: 'integer', nullable: false, default: null },
            ],
        });
        
        await this.editor.addNode(modelNode);
        
        // Position the node
        const x = 100 + (this.editor.getNodes().length - 1) * 250;
        const y = 100;
        await this.area.translate(modelNode.id, { x, y });
        
        // Update schema
        this.updateSchema();
        
        // Select the new node
        this.selectNode(modelNode.id);
        
        return modelNode;
    }
    
    selectNode(nodeId) {
        this.selectedNode = nodeId;
        const node = this.editor.getNode(nodeId);
        
        if (node instanceof ModelNode) {
            this.renderProperties(node);
        }
    }
    
    clearSelection() {
        this.selectedNode = null;
        this.renderEmptyProperties();
    }
    
    renderProperties(node) {
        const propertiesBody = document.getElementById('properties-body');
        if (!propertiesBody) return;
        
        propertiesBody.innerHTML = `
            <div class="property-section">
                <div class="property-section-title">Model Information</div>
                
                <div class="property-field">
                    <label>Model Name</label>
                    <input type="text" id="prop-model-name" value="${this.escapeHtml(node.modelName)}" placeholder="e.g., Pharmacy">
                </div>
                
                <div class="property-field">
                    <label>Table Name</label>
                    <input type="text" id="prop-table-name" value="${this.escapeHtml(node.tableName)}" placeholder="e.g., pharmacies">
                </div>
            </div>
            
            <div class="property-section">
                <div class="property-section-title">
                    Fields
                    <button id="add-field-btn" class="btn btn-primary btn-sm" style="float: right; margin-top: -4px;">
                        ➕ Add Field
                    </button>
                </div>
                
                <div class="fields-list" id="fields-list">
                    ${node.fields.length === 0 ? '<div class="empty-state" style="padding: 1rem;">No fields yet</div>' : ''}
                </div>
            </div>
            
            <div class="property-section">
                <button id="delete-model-btn" class="btn btn-danger btn-sm" style="width: 100%;">
                    🗑️ Delete Model
                </button>
            </div>
        `;
        
        // Render fields
        this.renderFields(node);
        
        // Setup property event listeners
        this.setupPropertyListeners(node);
    }
    
    renderFields(node) {
        const fieldsList = document.getElementById('fields-list');
        if (!fieldsList || node.fields.length === 0) return;
        
        fieldsList.innerHTML = node.fields.map((field, index) => `
            <div class="field-item" data-index="${index}">
                <div class="field-info">
                    <div class="field-name">${this.escapeHtml(field.name)}</div>
                    <div class="field-type">
                        ${this.escapeHtml(field.type)}
                        ${field.nullable ? ' • nullable' : ''}
                        ${field.default !== null && field.default !== '' ? ' • default: ' + this.escapeHtml(field.default) : ''}
                    </div>
                </div>
                <div class="field-actions">
                    <button class="btn btn-secondary btn-icon btn-sm edit-field-btn" data-index="${index}" title="Edit">
                        ✏️
                    </button>
                    <button class="btn btn-danger btn-icon btn-sm delete-field-btn" data-index="${index}" title="Delete">
                        🗑️
                    </button>
                </div>
            </div>
        `).join('');
        
        // Add event listeners for field actions
        fieldsList.querySelectorAll('.edit-field-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                this.editField(node, index);
            });
        });
        
        fieldsList.querySelectorAll('.delete-field-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                node.removeField(index);
                node.updateFieldsDisplay();
                this.renderFields(node);
                this.updateSchema();
                this.area.update('node', node.id);
            });
        });
    }
    
    setupPropertyListeners(node) {
        // Model name input
        const modelNameInput = document.getElementById('prop-model-name');
        if (modelNameInput) {
            modelNameInput.addEventListener('change', (e) => {
                node.modelName = e.target.value;
                node.updateLabel(e.target.value);
                this.updateSchema();
                this.area.update('node', node.id);
            });
        }
        
        // Table name input
        const tableNameInput = document.getElementById('prop-table-name');
        if (tableNameInput) {
            tableNameInput.addEventListener('change', (e) => {
                node.tableName = e.target.value;
                this.updateSchema();
            });
        }
        
        // Add field button
        const addFieldBtn = document.getElementById('add-field-btn');
        if (addFieldBtn) {
            addFieldBtn.addEventListener('click', () => this.addField(node));
        }
        
        // Delete model button
        const deleteModelBtn = document.getElementById('delete-model-btn');
        if (deleteModelBtn) {
            deleteModelBtn.addEventListener('click', async () => {
                if (confirm(`Are you sure you want to delete model "${node.modelName}"?`)) {
                    await this.editor.removeNode(node.id);
                    this.clearSelection();
                }
            });
        }
    }
    
    addField(node) {
        const newField = {
            name: `field${node.fields.length + 1}`,
            type: 'string',
            nullable: false,
            default: null,
        };
        
        node.addField(newField);
        node.updateFieldsDisplay();
        this.renderFields(node);
        this.updateSchema();
        this.area.update('node', node.id);
        
        // Auto-edit the new field
        setTimeout(() => this.editField(node, node.fields.length - 1), 10);
    }
    
    editField(node, index) {
        const field = node.fields[index];
        
        const fieldItem = document.querySelector(`[data-index="${index}"]`);
        if (!fieldItem) return;
        
        fieldItem.innerHTML = `
            <div style="width: 100%;">
                <div class="property-field" style="margin-bottom: 0.5rem;">
                    <label>Field Name</label>
                    <input type="text" class="edit-field-name" value="${this.escapeHtml(field.name)}" placeholder="e.g., name">
                </div>
                
                <div class="property-field" style="margin-bottom: 0.5rem;">
                    <label>Type</label>
                    <select class="edit-field-type">
                        <option value="string" ${field.type === 'string' ? 'selected' : ''}>string</option>
                        <option value="text" ${field.type === 'text' ? 'selected' : ''}>text</option>
                        <option value="integer" ${field.type === 'integer' ? 'selected' : ''}>integer</option>
                        <option value="boolean" ${field.type === 'boolean' ? 'selected' : ''}>boolean</option>
                        <option value="float" ${field.type === 'float' ? 'selected' : ''}>float</option>
                        <option value="date" ${field.type === 'date' ? 'selected' : ''}>date</option>
                        <option value="datetime" ${field.type === 'datetime' ? 'selected' : ''}>datetime</option>
                    </select>
                </div>
                
                <div class="property-field" style="margin-bottom: 0.5rem;">
                    <label>
                        <input type="checkbox" class="edit-field-nullable" ${field.nullable ? 'checked' : ''}>
                        Nullable
                    </label>
                </div>
                
                <div class="property-field" style="margin-bottom: 0.5rem;">
                    <label>Default Value</label>
                    <input type="text" class="edit-field-default" value="${field.default || ''}" placeholder="Leave empty for NULL">
                </div>
                
                <div style="display: flex; gap: 0.5rem;">
                    <button class="btn btn-primary btn-sm save-field-btn">💾 Save</button>
                    <button class="btn btn-secondary btn-sm cancel-field-btn">❌ Cancel</button>
                </div>
            </div>
        `;
        
        // Save button
        fieldItem.querySelector('.save-field-btn').addEventListener('click', () => {
            const updatedField = {
                name: fieldItem.querySelector('.edit-field-name').value,
                type: fieldItem.querySelector('.edit-field-type').value,
                nullable: fieldItem.querySelector('.edit-field-nullable').checked,
                default: fieldItem.querySelector('.edit-field-default').value || null,
            };
            
            node.updateField(index, updatedField);
            node.updateFieldsDisplay();
            this.renderFields(node);
            this.updateSchema();
            this.area.update('node', node.id);
        });
        
        // Cancel button
        fieldItem.querySelector('.cancel-field-btn').addEventListener('click', () => {
            this.renderFields(node);
        });
    }
    
    renderEmptyProperties() {
        const propertiesBody = document.getElementById('properties-body');
        if (!propertiesBody) return;
        
        propertiesBody.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">📦</div>
                <div>Select a model to view and edit its properties</div>
            </div>
        `;
    }
    
    updateSchema() {
        const models = this.editor.getNodes()
            .filter(node => node instanceof ModelNode)
            .map(node => {
                // Get relations for this model
                const relations = this.editor.getConnections()
                    .filter(conn => conn.source === node.id)
                    .map(conn => {
                        const targetNode = this.editor.getNode(conn.target);
                        return {
                            type: 'hasMany',
                            target: targetNode instanceof ModelNode ? targetNode.modelName : 'Unknown',
                        };
                    });
                
                return {
                    name: node.modelName,
                    table: node.tableName,
                    fields: node.fields,
                    relations: relations,
                };
            });
        
        schemaState.models = models;
        
        // Update JSON display
        this.renderJSON();
    }
    
    renderJSON() {
        const jsonDisplay = document.getElementById('json-display');
        if (!jsonDisplay) return;
        
        const schema = {
            models: schemaState.models
        };
        
        jsonDisplay.textContent = JSON.stringify(schema, null, 2);
    }
    
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', async () => {
    const container = document.getElementById('rete-editor');
    if (!container) {
        console.error('Editor container not found');
        return;
    }
    
    try {
        const editor = new SchemaEditor(container);
        await editor.initialize();
        
        // Make editor available globally for debugging
        window.schemaEditor = editor;
        
        console.log('Schema Editor initialized successfully');
    } catch (error) {
        console.error('Failed to initialize Schema Editor:', error);
    }
});
