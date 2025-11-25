/**
 * EventEmitter - Simple event emitter for MVC communication
 */
export class EventEmitter {
    constructor() {
        this._events = {};
    }

    /**
     * Register an event listener
     * @param {string} event - Event name
     * @param {Function} callback - Callback function
     * @returns {EventEmitter} this instance for chaining
     */
    on(event, callback) {
        if (!this._events[event]) {
            this._events[event] = [];
        }
        this._events[event].push(callback);
        return this;
    }

    /**
     * Remove an event listener
     * @param {string} event - Event name
     * @param {Function} callback - Callback function to remove
     * @returns {EventEmitter} this instance for chaining
     */
    off(event, callback) {
        if (!this._events[event]) {
            return this;
        }
        this._events[event] = this._events[event].filter(cb => cb !== callback);
        return this;
    }

    /**
     * Emit an event
     * @param {string} event - Event name
     * @param  {...any} args - Arguments to pass to listeners
     * @returns {EventEmitter} this instance for chaining
     */
    emit(event, ...args) {
        if (!this._events[event]) {
            return this;
        }
        this._events[event].forEach(callback => {
            try {
                callback(...args);
            } catch (error) {
                console.error(`Error in event listener for "${event}":`, error);
            }
        });
        return this;
    }
}
