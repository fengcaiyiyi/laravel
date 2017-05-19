@include('.layout/layout')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加分类</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ URL::route('feimo/addCategory') }}" class="form-horizontal" method="post" id="formdata">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">所属分类：</label>
                            <div class="col-sm-3">
                                <select class="form-control m-b" name="parentid" id="select">
                                    <option value="0">一级分类</option>
                                    @foreach ($list as $vo)
                                    <option value="{{$vo['id']}}">{{$vo['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">分类名称：</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary btn-add" type="button">保存内容</button>
                            </div>
                        </div>
                    </form>

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
<script src="{{ asset('js/jquery.form.js') }}"></script>
<script src="{{ asset('js/jquery-notifyjs/notify.min.js') }}"></script>
<script src="{{ asset('js/jquery-notifyjs/styles/metro/notify-metro.js') }}"></script>
<script src="{{ asset('js/pages/notifications.js') }}"></script>

<script>

    $(function () {
        $('.btn-add').click(function () {
            var name = $('#name').val();
            if (name == '') {
                notify('error', 'top center', '请填写分类名称');
                return false;
            }

            $("#formdata").ajaxSubmit({
                type: 'post',
                url: "{{ URL::route('feimo/addCategory') }}",
                success: function (data) {
                    if(data==1){
                        notify('error', 'top center', '分类已存在');
                    }else if (data == 'ok') {
                        notify('success', 'top center', '添加成功');
                        setTimeout(function () {
                            location.href = "{{ URL::route('feimo/category') }}"
                        }, 1000);
                    }
                }

            });
        });
    })
</script>



