import { NodeEditor, ClassicPreset } from 'rete';
import { AreaPlugin, AreaExtensions } from 'rete-area-plugin';
import { ConnectionPlugin, Presets as ConnectionPresets } from 'rete-connection-plugin';
import { VuePlugin, Presets as VuePresets } from 'rete-vue-plugin';

// Define Schemes
class Node extends ClassicPreset.Node {}
class Connection extends ClassicPreset.Connection {}

// Number Socket
const socket = new ClassicPreset.Socket('number');

// Number Node - displays a number value
class NumberNode extends ClassicPreset.Node {
    constructor(initial = 0, change) {
        super('Number');

        const control = new ClassicPreset.InputControl('number', {
            initial,
            change
        });
        this.addControl('value', control);
        this.addOutput('value', new ClassicPreset.Output(socket, 'Number'));
    }

    getValue() {
        return Number(this.controls.value.value) || 0;
    }
}

// Add Node - adds two numbers
class AddNode extends ClassicPreset.Node {
    constructor() {
        super('Add');

        this.addInput('a', new ClassicPreset.Input(socket, 'A'));
        this.addInput('b', new ClassicPreset.Input(socket, 'B'));
        this.addInput('c', new ClassicPreset.Input(socket, 'C'));
        this.addOutput('value', new ClassicPreset.Output(socket, 'Result'));
        this.inputA = 0;
        this.inputB = 0;
        this.inputC = 0;
    }

    getValue() {
        return this.inputA + this.inputB + this.inputC;
    }

    setInput(key, value) {

        switch (key) {
            case 'a':
                this.inputA = value;
                break;
            case 'b':
                this.inputB = value;
                break;
            case 'c':
                this.inputC = value;
                break;
        }
    }
}

// Display Node - shows the result
class DisplayNode extends ClassicPreset.Node {
    constructor() {
        super('Display');

        this.addInput('value', new ClassicPreset.Input(socket, 'Value'));
        const control = new ClassicPreset.InputControl('text', { initial: '0', readonly: true });
        this.addControl('display', control);
        this.currentValue = 0;
    }

    setValue(value) {
        this.currentValue = value;
        if (this.controls.display) {
            // Update the control value property directly
            this.controls.display.value = String(value);
        }
    }
}

// Process the dataflow through the network
function processDataflow(editor, area) {
    const connections = editor.getConnections();
    const nodes = editor.getNodes();

    // Create a map of node outputs
    const nodeOutputs = new Map();

    // First, get all number node values
    nodes.forEach(node => {
        if (node instanceof NumberNode) {
            nodeOutputs.set(node.id, { value: node.getValue() });
        }
    });

    // Process connections to calculate Add node values
    connections.forEach(conn => {
        const sourceNode = nodes.find(n => n.id === conn.source);
        const targetNode = nodes.find(n => n.id === conn.target);

        if (sourceNode && targetNode) {
            // Get the output value from source
            let outputValue = 0;
            if (sourceNode instanceof NumberNode) {
                outputValue = sourceNode.getValue();
            } else if (sourceNode instanceof AddNode) {
                outputValue = sourceNode.getValue();
            }

            // Set input on target
            if (targetNode instanceof AddNode) {
                targetNode.setInput(conn.targetInput, outputValue);
                // Store the calculated output
                nodeOutputs.set(targetNode.id, { value: targetNode.getValue() });
            } else if (targetNode instanceof DisplayNode) {
                targetNode.setValue(outputValue);
            }
        }
    });

    // Second pass for display nodes (in case they're connected to Add nodes)
    connections.forEach(conn => {
        const sourceNode = nodes.find(n => n.id === conn.source);
        const targetNode = nodes.find(n => n.id === conn.target);

        if (sourceNode instanceof AddNode && targetNode instanceof DisplayNode) {
            targetNode.setValue(sourceNode.getValue());
            // Force a re-render by updating the node
            area.update('node', targetNode.id);
        }
    });
}

// Initialize the Rete.js editor
export async function createEditor(container) {
    const editor = new NodeEditor();
    const area = new AreaPlugin(container);
    const connection = new ConnectionPlugin();
    const render = new VuePlugin();

    AreaExtensions.selectableNodes(area, AreaExtensions.selector(), {
        accumulating: AreaExtensions.accumulateOnCtrl()
    });

    render.addPreset(VuePresets.classic.setup());

    editor.use(area);

    area.use(connection);
    area.use(render);

    connection.addPreset(ConnectionPresets.classic.setup());

    // Create sample nodes with process callback for number nodes
    const n1 = new NumberNode(5, () => {
        processDataflow(editor, area);
    });
    await editor.addNode(n1);

    const n2 = new NumberNode(3, () => {
        processDataflow(editor, area);
    });
    await editor.addNode(n2);


    const n3 = new NumberNode(3, () => {
        processDataflow(editor, area);
    });
    await editor.addNode(n3);


    const add = new AddNode();
    await editor.addNode(add);

    const display = new DisplayNode();
    await editor.addNode(display);

    // Position nodes manually
    await area.translate(n1.id, { x: 100, y: 100 });
    await area.translate(n2.id, { x: 100, y: 300 });
    await area.translate(add.id, { x: 400, y: 200 });
    await area.translate(display.id, { x: 700, y: 200 });

    // Create connections
    await editor.addConnection(new Connection(n1, 'value', add, 'a'));
    await editor.addConnection(new Connection(n2, 'value', add, 'b'));
    await editor.addConnection(new Connection(add, 'value', display, 'value'));

    // Initial processing to calculate values
    setTimeout(() => {
        processDataflow(editor, area);
    }, 100);

    // Reprocess when connections change
    editor.addPipe(context => {
        if (context.type === 'connectioncreated' || context.type === 'connectionremoved') {
            setTimeout(() => processDataflow(editor, area), 10);
        }
        return context;
    });

    // Fit to viewport
    setTimeout(() => {
        AreaExtensions.zoomAt(area, editor.getNodes());
    }, 200);

    return { editor, area };
}

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('rete-editor');
    if (container) {
        createEditor(container).catch(console.error);
    }
});
