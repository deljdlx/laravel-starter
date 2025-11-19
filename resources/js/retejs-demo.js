import { NodeEditor, ClassicPreset } from 'rete';
import { AreaPlugin, AreaExtensions } from 'rete-area-plugin';
import { ConnectionPlugin, Presets as ConnectionPresets } from 'rete-connection-plugin';
import { VuePlugin, Presets as VuePresets } from 'rete-vue-plugin';
import { AutoArrangePlugin, Presets as ArrangePresets } from 'rete-auto-arrange-plugin';

// Define Schemes
class Node extends ClassicPreset.Node {}
class Connection extends ClassicPreset.Connection {}

// Number Socket
const socket = new ClassicPreset.Socket('number');

// Number Node - displays a number value
class NumberNode extends ClassicPreset.Node {
    constructor(initial = 0) {
        super('Number');
        
        const control = new ClassicPreset.InputControl('number', { initial });
        this.addControl('value', control);
        this.addOutput('value', new ClassicPreset.Output(socket, 'Number'));
    }
    
    data() {
        return {
            value: this.controls.value.value
        };
    }
}

// Add Node - adds two numbers
class AddNode extends ClassicPreset.Node {
    constructor() {
        super('Add');
        
        this.addInput('a', new ClassicPreset.Input(socket, 'A'));
        this.addInput('b', new ClassicPreset.Input(socket, 'B'));
        this.addOutput('value', new ClassicPreset.Output(socket, 'Result'));
    }
    
    data(inputs) {
        const a = inputs.a?.[0] || 0;
        const b = inputs.b?.[0] || 0;
        return {
            value: a + b
        };
    }
}

// Display Node - shows the result
class DisplayNode extends ClassicPreset.Node {
    constructor() {
        super('Display');
        
        this.addInput('value', new ClassicPreset.Input(socket, 'Value'));
        const control = new ClassicPreset.InputControl('text', { initial: '0', readonly: true });
        this.addControl('display', control);
    }
    
    data(inputs) {
        const value = inputs.value?.[0] || 0;
        if (this.controls.display) {
            this.controls.display.value = String(value);
        }
        return {};
    }
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

    // Create sample nodes
    const n1 = new NumberNode(5);
    await editor.addNode(n1);
    
    const n2 = new NumberNode(3);
    await editor.addNode(n2);
    
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

    // Fit to viewport
    setTimeout(() => {
        AreaExtensions.zoomAt(area, editor.getNodes());
    }, 100);

    return { editor, area };
}

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('rete-editor');
    if (container) {
        createEditor(container).catch(console.error);
    }
});
