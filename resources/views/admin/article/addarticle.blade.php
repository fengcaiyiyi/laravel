@include('.layout/layout')
<style>

    .btn-file { /*  上传按钮*/
        position: relative;
        overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        rightright: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: rightright;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加文章</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ URL::route('feimo/addArticle') }}" class="form-horizontal" method="post" enctype="multipart/form-data" >

                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章标题：</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">所属分类：</label>
                            <div class="col-sm-3">
                                <select class="form-control m-b" name="cid" id="select">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章内容：</label>
                            <div class="col-sm-3">
                                <textarea name="content" id="content"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <p style="padding-left:18%;color: red"> 默认自动提取您文章的前250字显示在博客首页作为文章摘要，您也可以在这里自行编辑</p>
                            <label class="col-sm-2 control-label">摘要：</label>
                            <div class="col-sm-3">
                                <textarea name="description" style="width: 1024px;height: 125px;"
                                          id="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">上传图片：</label>
                            <div class="col-sm-2">
                               <span class="btn btn-primary btn-file"> 选择图片
                                  <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                             <input type="file" name="pics" id="upimage"/>
                             </span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">图片预览：</label>
                            <div class="col-sm-2">
                                <div id="J_imageView"></div>
                                <div id="J_imageViewin"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">作者：</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="author" id="author">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">标签：</label>

                            <div class="col-sm-10">

                                <div class="radio i-checks">

                                    <input type="checkbox" value="" name=""> <i>aa</i></label>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否发布：</label>

                            <div class="col-sm-10">

                                <div class="radio i-checks">
                                    <input type="radio" value="0" name="is_show"> <i></i> 草稿</label>
                                    <input type="radio" checked="" value="1" name="is_show"> <i></i> 发布</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary btn-adds" type="submit">保存内容</button>
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


<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        window.UEDITOR_HOME_URL = "{{ asset('Ueditor/') }}";
        $(document).ready(function () {
            UE.getEditor('content', {
                initialFrameHeight: 450,
                initialFrameWidth: 1024,
                autoHeightEnabled: false,
            });
            var ue = UE.getEditor('content');
            ue.addListener("blur", function () {
                var editor = UE.getEditor('content');
                var arr = (UE.getEditor('content').getContentTxt());
                var description = document.getElementById("description");
                description.value = Generate_Brief(arr, 250);

            })

        });
    });


    $(function () {
        var cid = 1;
        $('#select').change(function () {
            var options = $("#select option:selected");
            cid = options.attr('id');
        })
        $('.btn-add').click(function () {
            var title = $('#title').val();
            var author = $('#author').val();
            if (title == '') {
                notify('error', 'top center', '请填写标题');
                return false;
            }

            if (author == '') {
                notify('error', 'top center', '请填写作者');
                return false;
            }
            $("#formdata").ajaxSubmit({
                type: 'post',
                url: "",
                data: {cid: cid},
                success: function (data) {
                    if (data == 'ok') {
                        notify('success', 'top center', '添加成功');
                        setTimeout(function () {
                            location.href = ""
                        }, 1000);
                    }
                }

            });
        });
    })

    $("#upimage").change(function () {
        $("#formdata").ajaxSubmit({
            type: 'post',
            url: '',
            success: function (e) {
                if (e == -1) {
                    notify('error', 'top center', '图片上传失败');
                } else {
                    var div = $('#J_imageView');
                    div.html("<img src='" + e + "'/>");
                    $('#J_imageViewin').html("<input type='hidden' name='pics' value='" + e + "'/>");
                }

            }
        });
    })

    function Generate_Brief(text, length) {
        if (text.length < length) return text;
        var Foremost = text.substr(0, length);
        var re = /<(\/?)(BODY|SCRIPT.|P|DIV|H1|H2|H3|H4|H5|H6|ADDRESS|PRE|TABLE|TR|TD|TH|INPUT|SELECT|TEXTAREA|OBJECT|A|UL|OL|LI|BASE|META.|LINK|HR|BR|PARAM|IMG|AREA|INPUT|SPAN)[^>]*(>?)/ig;
        var Singlable = /BASE|META.|LINK|HR|BR|PARAM|IMG|AREA|INPUT/i
        var Stack = new Array(), posStack = new Array();
        while (true) {
            var newone = re.exec(Foremost);
            if (newone == null) break;
            if (newone[1] == "") {
                var Elem = newone[2];
                if (Elem.match(Singlable) && newone[3] != "") {
                    continue;
                }
                Stack.push(newone[2].toUpperCase());
                posStack.push(newone.index);
                if (newone[3] == "") break;
            } else {
                var StackTop = Stack[Stack.length - 1];
                var End = newone[2].toUpperCase();
                if (StackTop == End) {
                    Stack.pop();
                    posStack.pop();
                    if (newone[3] == "") {
                        Foremost = Foremost + ">";
                    }
                }
            }
            ;
        }
        var cutpos = posStack.shift();
        Foremost = Foremost.substring(0, cutpos);
        return Foremost;
    }

    $("#content").on("mouseover", "#view", function () {
        console.log('ok');
    })
    function add_change_listener(shellId) {
        //编辑内容改变监听事件
        //一般的字符都可以监听，但是@#￥%……这些字符的输入是监听不到的。所以采用如下的方法：

        $('#' + shellId + ' #edui1_toolbarbox').css('display', 'none');
        editor.fireEvent("contentChange");

        var $textarea = $('#' + shellId + '').parent().find('iframe').contents();

        var fn = function () {
            g_content_changed = true;
            console.log('content_changed1, g_content_changed=' + g_content_changed);
        }

        if (document.all) {
            $textarea.get(0).attachEvent('onpropertychange', function (e) {
                fn();
            });
        } else {
            $textarea.on('input', fn);
            $textarea.on('keyup', fn);
        }
    }


</script>



