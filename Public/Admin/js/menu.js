/**
 * Created by Administrator on 2017/8/26 0026.
 */
$(function () {

    // $('#menu-ul').each(function (index) {
    //     $(this).find('.menu-li ').on('click',function () {
    //         //alert('');
    //         //alert(obj.tagName);
    //         //alert($(this).attr('class'));
    //         liThis = this;
    //         if ($(this).attr('class')==="menu-li collapse"){
    //             $(this).removeClass('collapse').addClass('explode');
    //             $(this).find('ul').css('display','block');
    //         }else if($(this).attr('class')==="menu-li explode"){
    //             $(this).removeClass('explode').addClass('collapse');
    //             $(this).find('ul').css('display','none');
    //         }
    //     })
    // });

    $('#menu-ul').on('click',' li',function (e) {
        //alert($(this).attr('class'));
        if ($(this).attr('class')==="menu-item"){
            e.stopPropagation();
            //return false;
        }
        if ($(this).attr('class')==="menu-li collapse"){
            $(this).removeClass('collapse').addClass('explode');
            $(this).find('ul').css('display','block');
        }else if($(this).attr('class')==="menu-li explode"){
            $(this).removeClass('explode').addClass('collapse');
            $(this).find('ul').css('display','none');
        }
    })

});