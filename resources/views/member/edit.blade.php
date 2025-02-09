<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('members.index')}}">{{ __('會員管理') }}</a>

            > {{ __('編輯') }} : {{$item->name}}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        @can('會員管理_刪除')
            <form method="post" action="{{route('members.destroy',['member'=>$item->id])}}">
                @csrf
                @method('delete')
                <button class="btn btn-danger" onclick="confirm('是否確認刪除')">刪除</button>
            </form>
        @endcan
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:update-forms.member :id="$item->id" />
            </div>
        </div>
    </div>

    <!-- 手動補扣 -->
    <div class="modal modal-sm fade" id="customPointMinus">
        <div class="modal-dialog">
            <form method="post" action="{{route("members.point.minus",["id"=>$item->id])}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">手動扣點</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">點數</label>
                            <input type="number" min="1" class="form-control" name="point">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal modal-sm fade" id="customPointAdd">
        <div class="modal-dialog">
            <form method="post" action="{{route("members.point.add",["id"=>$item->id])}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">手動補點</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">點數</label>
                            <input type="number" min="1" class="form-control" name="point">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
