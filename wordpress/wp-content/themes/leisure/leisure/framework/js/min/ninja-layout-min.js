!function($){$(document).ready(function(){$("#gridly").sortable({placeholder:"ui-state-highlight",start:function(e,l){0===$(".inner",l.placeholder).length&&$(l.placeholder).append('<div class="inner"></div>'),$(l.placeholder).width($(l.item).width())}}),$("#gridly").disableSelection(),$(".size").on("change",function(){var e=null;switch($(this).val()){case"2":e="col_1_2";break;case"3":e="col_1_3";break;case"4":e="col_1_4";break;case"5":e="col_2_3";break;case"6":e="col_2_4";break;case"7":e="col_3_4"}$(this).siblings("input[type=hidden]").val($(this).val()),$(this).parent().parent().removeClass("col_1_2 col_1_3 col_1_4 col_2_3 col_2_4 col_3_4").addClass(e)})})}(jQuery);