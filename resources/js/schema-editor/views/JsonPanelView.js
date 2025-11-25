/**
 * JsonPanelView - Responsible for rendering the JSON debug panel
 * Pure view class - only handles DOM rendering
 */
export class JsonPanelView {
    /**
     * @param {string} elementId - ID of the JSON panel container
     */
    constructor(elementId = 'json-debug-panel') {
        this._elementId = elementId;
    }

    /**
     * Render the JSON panel with schema data
     * @param {Object} schema - Schema data to display
     */
    render(schema) {
        const panel = document.getElementById(this._elementId);
        if (!panel) {
            return;
        }

        panel.textContent = JSON.stringify(schema, null, 2);
    }
}
