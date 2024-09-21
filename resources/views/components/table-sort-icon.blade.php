@props(["sortByColumn"=>"","sortByDirection"=>"","column"=>""])

@if($sortByColumn==$column && $sortByDirection=="asc") <i class="fa fa-fw fa-sort-up"></i>
@elseif($sortByColumn==$column && $sortByDirection=="desc") <i class="fa fa-fw fa-sort-down"></i>
@else <i class="fa fa-fw fa-sort"></i>
@endif
