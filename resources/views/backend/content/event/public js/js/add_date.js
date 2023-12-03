jQuery(document).ready(function () {
    
    //$('#list-items').html(localStorage.getItem('listItems'));

    $('.add-items').click(function (event) {

        event.preventDefault();

        var item = $('#date-list-item').val();
        item = item.replace("T", " ");

        if (item) {
            $('#list-items').append("<li><span class='date-text'>" + item + "</span><a class='remove text-right'><i class='fa fa-trash'></i></a><hr></li>");

            //localStorage.setItem('listItems', $('#list-items').html());

            $('#date-list-item').val("");
        }

    });

    $(document).on('click', '.remove', function () {
        $(this).parent().remove();

        localStorage.setItem('listItems', $('#list-items').html());
    });

});

function d(){
    alert("a");
}