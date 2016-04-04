var selected;

/**
 * Update our hidden field based on our selected values
 */
function updateHidden() {
    var hidden = document.getElementById('contacts');
    var cost   = document.getElementById('cost');
    var cred   = document.getElementById('cred');
    var val    = [];
    
    for (var key in selected) {
        var value = selected[key];
        
        // Check if the value is positive, if so, add it to our values
        if(value > 0) {
            val.push(key);
        } else if(value < 0) {
            // If the value is negative, set it to 0, it can only be 0 or positive
            selected[key] = 0;
        }
    }
    
    hidden.value = val;
    cost.innerHTML = val.length;
    
    // Just a small bit of UX (if the length is 1, set it to credit
    // otherwise, set it to credits)
    cred.innerHTML = val.length === 1 ? 'Credit' : 'Credits';
}

/**
 * Style the selectAll div
 * @param {HTMLElement} selectAll
 */
function styleSelectAll(selectAll) {
    if(selectAll.selected) {
        selectAll.innerHTML         = 'Alles Deselecteren';
        selectAll.style.background  = '#FF5722';
        selectAll.style.color       = '#FFFFFF';
        selectAll.style.fontStyle   = 'italic';
    } else {
        selectAll.innerHTML         = 'Alles Selecteren';
        selectAll.style.background  = '#FFFFFF';
        selectAll.style.color       = '#212121';
        selectAll.style.fontStyle   = 'normal';
    }
}

/**
 * Select or deselect all, based on the selected attribute of the select-all element
 * @param {integer} id
 */
function selectOrDeselectAll(id) {
    var parent = document.getElementById(id + '_select-all');
    
    if(parent.selected == undefined || parent.selected == false) {
        selectAll(id, parent);
    } else {
        deselectAll(id, parent);
    }
    
    styleSelectAll(parent);
    updateHidden();
    updateNumber(id);
}

/**
 * Select all items of a selector
 * @param {integer}     id
 * @param {HTMLElement} parent
 */
function selectAll(id, parent) {
    var selector = document.getElementById(id + '_selector');
    var items = selector.getElementsByClassName('item').array();
    
    var selected = [];
    var select = [];
    
    for(var key in items) {
        select.push(items[key].getAttribute('contact_id'));
        if(items[key].getAttribute('active') === null) {
            selected.push(items[key].getAttribute('contact_id'));
            update(items[key], true);
        }
    }
    
    parent.selected = true;
    
    selector.selected = select;
}

/**
 * Deselect all items of a selector
 * @param {integer}     id
 * @param {HTMLElement} parent
 */
function deselectAll(id, parent) {
    var selector = document.getElementById(id + '_selector');
    var items = selector.getElementsByClassName('item').array();
    
    for(var key in items) {
        update(items[key], false);
    }
    
    selector.selected = [];
    
    parent.selected = false;
}

/**
 * Toggle a group
 * @param {integer} id
 */
function toggle(id) {
    var div = document.getElementById('group_' + id);
    var caret = document.getElementById('group_caret_' + id);
    var content = document.getElementById('group_content_' + id);
    
    // If the div isnt initiated yet
    if(div.opened == undefined) {
        div.opened = 0;
    }
        
    // Toggle the div
    div.opened = !div.opened;
    
    if(div.opened) {
        // Set the caret to Triangle Up
        caret.innerHTML = '&#9650;';
        
        // Display the content of the div
        content.style.display = 'block';
    }
    else {
        // Set the caret to Triangle Down
        caret.innerHTML = '&#9660;';
        
        // Hide the content of the div
        content.style.display = 'none';
    }
}

/**
 * Update our selectAll element
 * @param {integer} id
 */
function updateSelectAll(id) {
    var select_all  = document.getElementById(id + '_select-all');
    var selector    = document.getElementById(id + '_selector');
    var items       = selector.items;
    var selected    = selector.selected;
    
    items = (items !== null ? items : []);
    selected = (selected !== null ? selected : []);
    
    if(items.length === selected.length) {
        select_all.selected = true;
    } else {
        select_all.selected = false;
    }
    
    styleSelectAll(select_all);
}

/**
 * Update the amount of selected items
 * @param {integer} id
 */
function updateNumber(id) {
    var selector = document.getElementById(id + '_selector');
    var number   = document.getElementById('group_number_' + id)
    var selected = selector.selected === null ? 0 : selector.selected.length;
    var items    = selector.items === null ? 0 : selector.items.length;
    
    number.innerHTML = selected + '/' + items;
}

/**
 * Update an item, get either its value or use {value}
 * @param {integer} item
 * @param {boolean} value
 */
function update(item, value) {
    var id          = item.getAttribute('contact_id');
    var group_id    = item.getAttribute('group_id');
    
    if(value === undefined) {
        if(value === true || item.getAttribute('active') !== null) {
            selected[id]++;
        } else {
            selected[id]--;
        }
    } else {
        if(value === true) {
            selected[id]++;
        } else {
            selected[id]--;
        }
    }
        
    updateHidden();
    updateSelectAll(group_id);
    updateNumber(group_id);
}

/**
 * Get and update the item if its being activated by a click
 */
document.addEventListener('core-activate', function(e) {
    var item = e.detail.item;
    update(item);
})