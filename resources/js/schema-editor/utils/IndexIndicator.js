/**
 * IndexIndicator - Shared utility for rendering index type indicators
 * Ensures consistent rendering across all views
 */
export class IndexIndicator {
    /**
     * Render index indicator HTML
     * @param {string} indexType - Index type (primary, index, unique, none)
     * @param {Object} options - Optional styling options
     * @param {boolean} options.inline - Use inline styles instead of CSS classes
     * @returns {string} HTML string for the indicator
     */
    static render(indexType, options = {}) {
        const inline = options.inline || false;

        switch (indexType) {
            case 'primary':
                return inline
                    ? '<span style="color: #8b5cf6; margin-left: 0.25rem;" title="Primary Key">🔑</span>'
                    : '<span class="unique-indicator" title="Primary Key">🔑</span>';
            case 'index':
            case true:
                return inline
                    ? '<span style="color: #10b981; margin-left: 0.25rem;" title="Index">🔍</span>'
                    : '<span class="index-indicator" title="Index">🔍</span>';
            case 'unique':
                return inline
                    ? '<span style="color: #8b5cf6; margin-left: 0.25rem;" title="Unique Index">1️⃣</span>'
                    : '<span class="unique-indicator" title="Unique Index">1️⃣</span>';
            default:
                return '';
        }
    }
}
