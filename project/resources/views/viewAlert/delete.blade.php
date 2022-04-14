
<div class="delete">
 
 
    <h1>Are you sure?</h1>
    <span>Do you really want to delete these records? This process can't be undone</span>

<div class="chose">
    <button class="cancel">Cancel</button>
    <form action="/admin/posts/delete" method="POST">
        <input type="hidden" value="{{$id}}" name="id">
        @csrf
        <button type="submit"class="dele">Delete</button>
    </form>
</div>
</div>
