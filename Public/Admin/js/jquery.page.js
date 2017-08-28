/**
 * Created by Administrator on 2017/8/1 0001.
 * 分页插件
 */
(function ($) {
    $.fn.extend({
        "pageInit":function(options){
            var defaults={
                totalNum:10,              //总记录数
                showNum:5,               //每页显示条数
                pageDiv:2,               //分页间距
                url: "",                 //后台页面
                type: "POST",           //AJAX提交方式
                dataType: "",           //后台返回的数据格式
                data:null,              //提交的数据
                beforeSend: null,      //提交前的动作
                success: null,          //提交成功后的动作
                complete: null,         //请求处理完成后的动作
                error: function () {    //错误提示
                alert("抱歉,请求出错,请重新请求！");
               },
            };
            var opts=$.fn.extend(defaults,options);   //覆盖插件默认参数
            var showRepeat='';   //分页样式
            var totalPage='';    //总页码
            totalPage = Math.ceil(opts.totalNum/opts.showNum);
            if (totalPage>1){  //大于一页才显示,并且第一页为选定状态
                showRepeat +='<span class="page_span"><a href="javascript:;" page="1" class="page_data selected">'+1+'</a></span>';
                if (totalPage<5){
                    for (var i=1;i<totalPage;i++){
                        showRepeat +='<span class="page_span"><a href="javascript:;" page="'+(i+1)+'" class="page_data">'+(i+1)+'</a></span>';
                    }
                }else {
                    //大于4页时，显示123...最后一页
                    for (var j=1;j<4;j++){
                        showRepeat +='<span class="page_span"><a href="javascript:;" page="'+(j+1)+'" class="page_data">'+(j+1)+'</a></span>';
                    }
                    showRepeat +='<span class="page_span disable">...</span>';
                    showRepeat +='<span class="page_span"><a href="javascript:;" page="'+totalPage+'" class="page_data">'+totalPage+'</a></span>';
                }

            }
            //判断page如果有变更则刷新页面显示

            //this.append(showRepeat);
            if ((this.find('span').length!=totalPage)&&(this.find('span').length!=0)){
                //alert('');
                this.empty();
                this.append(showRepeat);

            }else if(this.find('span').length==0){
                this.append(showRepeat);
            }
            //点击分页处理
            var divThis=this;
            this.on('click','.page_data',function () {
                var aThis=this;
                var clickPage = parseInt($(this).text());
                divThis.empty();
                divThis.append(getPageList(clickPage,totalPage,opts.pageDiv));
                $.ajax({
                    url:opts.url,
                    type:opts.type,
                    dataType:opts.dataType,
                    data:{
                        page:clickPage,          //点击的页面
                        dataArr:JSON.stringify(opts.data),      //用户自定义,以JSON格式传递
                    },
                    beforeSend:opts.beforeSend,
                    success:opts.success,
                    complete:opts.complete
                })
            });
            function page(page,totalPage,PageDiv) {
                var tmp='';
                var pageList='';
                for (var i = PageDiv;i>=1;i--){
                    tmp = page-i;
                    if (tmp<1) continue;
                    pageList+= '<span class="page_span"><a href="javascript:;" page="'+(tmp)+'" class="page_data">'+(tmp)+'</a></span>';
                }
                pageList += '<span class="page_span"><a href="javascript:;" page="'+(page)+'" class="page_data selected">'+(page)+'</a></span>';
                for (var j = 1;j<PageDiv; j++){
                    tmp = page+j;
                    if (tmp>totalPage) break;
                    pageList += '<span class="page_span"><a href="javascript:;" page="'+(tmp)+'" class="page_data">'+(tmp)+'</a></span>';
                }
                return pageList;
            }

            //首页
            function first(page,PageDiv) {
                if (page-1>PageDiv){
                    return '<span class="page_span"><a href="javascript:;" page="'+1+'" class="page_data">'+1+'</a></span>'+
                        '<span class="page_span">...</span>';
                }
                return " ";
            }
            function last(page,totalPage,PageDiv) {
                if (totalPage-page>PageDiv){
                    return '<span class="page_span">...</span>'
                        +'<span class="page_span"><a href="javascript:;" page="'+totalPage+'" class="page_data">'+totalPage+'</a></span>';
                }
                return " ";
            }

            /**
             * 对外呈现的分页样式
             * @param clickPage       //点击的页数
             * @param totalPage       //总页数
             * @param PageDiv         //分页间距
             * @returns {*}
             */
            function getPageList(clickPage,totalPage,PageDiv) {
                var pageList = first(clickPage,PageDiv)+page(clickPage,totalPage,PageDiv)+last(clickPage,totalPage);
                return pageList;
            }
        },

    });
})(window.jQuery);
