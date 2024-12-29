<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('goods.index')}}">{{ __('主商品管理') }}</a>

            > {{ __('編輯') }} : {{$item->name}}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        <div class="d-flex">
            <a class="btn btn-primary mr-2" href="{{route('goods.edit',['goods'=>$item])}}">商品編輯</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row">
                    <div class="col-12 col-md-12 p-3 text-gray-900">
                        <div class="p-2 ">
                            <form method="post" action="{{route('goods.update2',['goods'=> $item])}}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label px-2">商品介紹</label>
                                    <textarea class="form-control" id="content" name="content1" rows="5">{{$item->content1}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <div class="flex justify-content-between">
                                        <div>
                                            <button type="submit" class="btn btn-primary">
                                                儲存
                                            </button>
                                            <button type="button" class="btn btn-secondary">取消</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--編輯器-->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/froala_editor.min.js?v=1"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/align.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/code_beautifier.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/code_view.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/draggable.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/image.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/image_manager.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/link.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/lists.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/paragraph_format.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/paragraph_style.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/table.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/video.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/url.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/entities.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/font_size.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/colors.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/font_family.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/plugins/line_height.min.js"></script>
    <script type="text/javascript" src="/froala_editor_3.2.6-1/js/languages/zh_tw.js"></script>
    <script>
        //editor
        const editorInstance = new FroalaEditor('#content', {
            enter: FroalaEditor.ENTER_P,
            placeholderText: null,
            imageUploadURL: '/web/editor?_token={{ csrf_token() }}',
            language: 'zh_tw',
            events: {
                initialized: function () {
                    // const editor = this
                    // this.el.closest('form').addEventListener('submit', function (e) {
                        // console.log(editor.$oel.val());
                        // e.preventDefault()
                    // })
                },
            },
            fontFamily: {
                "'Noto Sans TC',sans-serif": '思源黑體',
                "'Noto Serif SC',sans-serif": 'Noto Serif SC',
                "'PMingLiU',sans-serif": '新細明體',
                "'DFKai-sb',sans-serif": '標楷體',
                "'Microsoft JhengHei',sans-serif": '微軟正黑體',
            },
        });
    </script>
</x-app-layout>
