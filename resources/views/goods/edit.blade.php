<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('goods.index')}}">{{ __('主商品管理') }}</a>

            > {{ __('編輯') }} : {{$item->name}}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        @can('主商品管理_刪除')
            <form method="post" action="{{route('goods.destroy',['goods'=>$item->id])}}">
                @csrf
                @method('delete')
                <button class="btn btn-danger" onclick="confirm('是否確認刪除')">刪除</button>
            </form>
        @endcan
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:update-forms.goods :id="$item->id" />
            </div>
        </div>
    </div>



    <script src="/web/js/bootstrap-table.min.js"></script>
    <script src="/web/js/tableExport.min.js"></script>
    <script src="/web/js/bootstrap-table-export.min.js"></script>

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
            imageUploadURL: '/web/editor',
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
