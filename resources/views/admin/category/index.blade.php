@include('.layout/layout')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">


                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>分类名称</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($list as $vo)
                        <tr>
                            <td>{{$vo['id']}}</td>
                            <td>{{$vo['name']}}</td>
                            <td><a href="javascript:void(0)"><i class="fa fa-times "  id="{{$vo['id']}}"></i></a>
                                <a href="{{ URL::route('feimo/editCategory',[$vo['id']]) }}"><i class="fa fa-check-square-o "></i></a>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

</div>
<!-- 全局js -->
<script src="{{ asset('js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('js/bootstrap.min.js?v=3.3.6') }}"></script>

<!-- 自定义js -->
<script src="{{ asset('js/content.js?v=1.0.0') }}"></script>

<!-- iCheck -->
<script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('Ueditor/ueditor.config.js') }}"></script>
<script src="{{ asset('Ueditor/ueditor.all.js') }}"></script>
<script src="{{ asset('Ueditor/lang/zh-cn/zh-cn.js') }}"></script>
<script src="{{ asset('js/jquery-notifyjs/notify.min.js') }}"></script>
<script src="{{ asset('js/jquery-notifyjs/styles/metro/notify-metro.js') }}"></script>
<script src="{{ asset('js/pages/notifications.js') }}"></script>
<script>


    $('.fa-times').click(function(){
        var url="{{ URL::route('feimo/delCategory',['']) }}/";
        var id = $(this).attr('id');
        url=url+id;
        if(confirm('确定删除？')){
            console.log(url);
            $.post(url,function(data){
                if(data==1){
                    notify('error', 'top center', '该分类下有子类');
                }else if (data == 'ok') {
                    notify('success', 'top center', '删除成功');
                    setTimeout(function () {
                        location.reload()
                    }, 1000);
                }

            })
        }
    })

</script>





