<div style="display:inline-flex">
    <form method="GET" action="{{ route('search_contact') }}"> 
        @if(isset($keyword_status))
            <input type="hidden" name="status" value="{{ $keyword_status }}">
        @endif
        @if(isset($keyword_authority))
            <input type="hidden" name="authority" value=" {{ $keyword_authority }}">
        @endif
        @if(isset($keyword_company))
            <input type="hidden" name="company" value=" {{ $keyword_company }}">
        @endif
        <input type="hidden" name="sort" value="{{ $asc }}">
        <input type="hidden" name="sort_name" value="sort_{{ $item }}">
        <button type="submit">{{ $arrow_up }}</button>
    </form>    
    <form method="GET" action="{{ route('search_contact') }}"> 
        @if(isset($keyword_status))
            <input type="hidden" name="status" value="{{ $keyword_status }}">
        @endif
        @if(isset($keyword_authority))
            <input type="hidden" name="authority" value=" {{ $keyword_authority }}">
        @endif
        @if(isset($keyword_company))
            <input type="hidden" name="company" value=" {{ $keyword_company }}">
        @endif
        <input type="hidden" name="sort" value="{{ $desc }}">
        <input type="hidden" name="sort_name" value="sort_{{ $item }}">
        <button type="submit">{{ $arrow_under }}</button>
    </form>    
</div>