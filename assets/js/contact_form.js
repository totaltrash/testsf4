$(document).ready(function () {
    $('.contact-attr-collection').on('click', '.contact-attr-delete', function () {
        deleteAttribute($(this));

    });
    $('.add-button').click(function (e) {
        addAttribute($(this));
    });
});

function reindexCollection(collection) {
    let index = 0;
    $('.contact-attr', collection).each(function () {
        //update the name attribute of any inputs and selects
        $('[name]', $(this)).each(function () {
            let newId = $(this).attr('id').replace(/_\d_/, '_' + index + '_');
            let newName = $(this).attr('name').replace(/\[\d\]/, '[' + index + ']');
            $(this).attr('id', newId);
            $(this).attr('name', newName);
        });
        index++;
    });

    // show/hide empty row
    if (index === 0) {
        $('.empty-row', collection).removeClass('d-none');
    } else {
        $('.empty-row', collection).addClass('d-none');
    }
}

function deleteAttribute(button) {
    let collection = button.closest('.contact-attr-collection');
    button.closest('.contact-attr').remove();
    reindexCollection(collection);
}

function addAttribute(button) {
    let collection = button.closest('.contact-attr-collection');
    let newForm = collection.data('prototype');

    newForm = newForm.replace(/__name__/g, 0);
    collection.append(newForm);
    reindexCollection(collection);
}
