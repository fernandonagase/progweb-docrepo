class DocumentGrid {
    constructor(el) {
        this.el = el;
        this.gridSelectedItem = null;
        this.gridItemSelectedClass = 'document-grid-item-selected';
    }

    selectGridItem(gridItem) {
        if (gridItem === this.gridSelectedItem) return;
        if (this.gridSelectedItem != null) this.deselectGridItem(this.gridSelectedItem);
        this.gridSelectedItem = gridItem;
        gridItem.classList.add(this.gridItemSelectedClass);
    }

    deselectGridItem(gridItem) {
        if (gridItem === null) return;
        if (gridItem != this.gridSelectedItem) return;
        this.gridSelectedItem = null;
        gridItem.classList.remove(this.gridItemSelectedClass);
    }
}

