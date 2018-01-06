$(document).ready(function () {
    
    $('#custom_rating').on('click','.removeAward',function(){
        $(this).parent().remove();
        indexFields();
    });
    
    $('#custom_rating').on('change','.customRating',function () {
        $this = $(this);
        option = $('option:selected', $(this));
                
        min = option.attr('data-min');
        max = option.attr('data-max');
        container = $this.parent().parent();
        switch (option.attr('data-type'))
        {
            case 'stars':
                $('.custom_rating_value',container).fadeIn();
                html = "<input class='form-control input-lg' type='number' name='ratingValue[]' placeholder='Étoiles (" + min + "-" + max + ")' min='" + min + "' max='" + max + "' />";
                $('.custom_rating_value',container).html(html);
                break;
            case 'award_places':
                $('.custom_rating_value',container).fadeIn();
                html = "<select name='ratingValue[]' class='form-control input-lg'>";
                values = option.attr('data-values').split("{|}");
                $.each(values, function (index, value) {
                    v = value.split("::");
                    html += "<option value='" + v[0] + "'>" + v[1] + "</option>";
                });
                html += "</select>";
                $('.custom_rating_value',container).html(html);
                break;
            case 'points':
                $('.custom_rating_value',container).fadeIn();
                html = "<input class='form-control input-lg' type='number' name='ratingValue[]' placeholder='Points (" + min + "-" + max + ")' min='" + min + "' max='" + max + "' />";
                $('.custom_rating_value',container).html(html);
                break;
            default:
                $('.custom_rating_value',container).html('');
                break;
        }
        indexFields();
    });
    
    $('.custom_rating').on('change','input[name=ratingValue]',function(){
        validateRatingValue();
    });
    
    $('#form-product').submit(function(e){
        if(validateRatingValue())
        {
            $(this).submit();
        } else {
            e.preventDefault();
            return false;
        }
    });
    
});

function validateRatingValue()
{
    var valid = true;
    
    $('.custom_rating_value input').each(function(){
        $this = $(this);
        $min = $this.attr('min');
        $max = $this.attr('max');
        $val = $this.val();

        if(parseInt($val) >= parseInt($min) && parseInt($val) <= parseInt($max))
        {
            $this.css('border-color','#ccc');
        } else {
            $this.css('border-color','red');
            valid = false;
        }
    });
    
    if(valid)
        return true;
    else
        return false;
    
}

function addRating()
{
    $html = $('.ratingHolder:first').clone();
    $('.custom_rating_value',$html).html('');
    $('.customRating',$html).val('');
    $html.append('<button type="button" class="btn btn-danger removeAward"><i class="fa fa-minus-circle"></i></button>');
    $('.customRating option:selected').each(function(){
        if($(this).val())
            $('option[value='+$(this).val()+']',$html).remove();
    });
    if($('option',$html).length === 1) {
        alert("No more available awards!");
    } else {
        $('#custom_rating td:last').append($html);
        indexFields();
    }
}

function indexFields()
{
    var $i = 0;
    $('.ratingHolder').each(function(){
        $('.customRating',$(this)).attr('name','customRating['+$i+']');
        $('.custom_rating_value input, .custom_rating_value select',$(this)).attr('name','ratingValue['+$i+']');
        ++$i;
    });
}