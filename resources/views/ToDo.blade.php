<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<br>
<div class="container">
     <div class="row">
         <div class="col-lg-offset-3 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ToDo List <a href="#" id="Add_Notes" class="pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></a></h3>
                </div>
                <div class="panel-body" id="datatodisplay">
                  <ul class="list-group">
                  @forelse($Notes as $note)
                   <li class="list-group-item o_item" id="Listitems" data-toggle="modal" data-target="#myModal">{{ $note->note }}</li>
                   <input type="hidden" id="itemid" value="{{ $note->id }}">
                 @empty
                           <h1> No Notes Found Add now <a href="#" id="Add_Notes" class="pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></a></h1>
                 @endforelse
                 </ul>
                </div>
            </div>
         </div>
     </div>
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="title">Add Notes</h4>
      </div>
       <div class="modal-body">
        <p>
         <input type="hidden" id="id">
         <input type="text" placeholder="Write some thing" id="Aitem" class="form-control">
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="display:none">Close</button>
        <button type="button" class="btn btn-warning"id="delete" style="display:none">Delete</button>
        <button type="button" class="btn btn-primary" id="save_changes" style="display:none">Save changes</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="A_Button">Add Notes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Csrf_token-->
{{ csrf_field() }}
<!-- jQuery library -->
{{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  --}}
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<!--Javascript library -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
 // ajax Code
 $(document).ready(function(){
     // click event on the basis of class of list-item

       $(document).on('click', '#Listitems', function(event){
                 // getting the text of list item on the basis of id
                   var text = $(this).text();
                   // getting the id from the outitem input field
                   var id = $(this).find('#itemid').val();
                   console.log(id);
                   // changing the title
                    $('#title').text('Edit Notes');
                   // displaying lis-item text in the modal text box via id
                   $('#Aitem').val(text);
                   // Displaying delete button
                   $('#delete').show('400');
                   // Displaying save changes Button
                   $('#save_changes').show('400');
                   //hiding the add notes button
                   $('#A_Button').hide('400');
                   // setting the id to the modal input hidden if field after getting from the ui-list itemid
                   $('#id').val(id);
                   console.log(text);
                   
       });

     // for each
       /* $('.o_item').each(function(){
            $(this).click(function(event){
                   // getting the text of list item on the basis of id
                   var text = $(this).text();
                   // changing the title
                    $('#title').text('Edit Notes');
                   // displaying lis-item text in the modal text box via id
                   $('#Aitem').val(text);
                   // Displaying delete button
                   $('#delete').show('400');
                   // Displaying save changes Button
                   $('#save_changes').show('400');
                   //hiding the add notes button
                   $('#A_Button').hide('400');
                   console.log(text);
            }); */
       //});

       // buttonclick event for Plus icon add new notes
        $(document).on('click', '#Aitem', function(event){
            
                   // changing the title
                   $('#title').text('Add Notes');
                   // displaying lis-item text in the modal text box via id
                   $('#Aitem').val("");
                   // Displaying delete button
                   $('#delete').hide('400');
                   // Displaying save changes Button
                   $('#save_changes').hide('400');
                   //hiding the add notes button
                   $('#A_Button').show('400');
                   //console.log(text);
            
       });

       // button click event for add new Notes Modal

       $('#A_Button').click(function(event){

         var text = $('#Aitem').val();
          
         if(text != "")
         {
         //Posting the data via post Method
         // passing text and a variable text
          $.post('AddNotes', {'text': text, '_token':$('input[name=_token]').val()} , function(data){
            console.log(data);
            // refreshing the div
            $('#datatodisplay').load(location.href + ' #datatodisplay');
          });
         }
         else
         {
           alert("Enter Notes or someother info");
         }

         

       });
 
       // function to delete items
       $('#delete').click(function(event){
               var id = $("#id").val();
               $.post('Delete', {'id':id,'_token':$('input[name=_token]').val()}, function(data){
                      $('#tasks').load(location.href + ' #datatodisplay');
                      console.log(data);
                      console.log(id);
                });
               

       });

       //Function to edit notes
        $('#save_changes').click(function(event) {
            /* Act on the event */
            var id = $("#id").val();
            var value = $('#Aitem').val();
            $.post('/edit', {'id': id, 'value': value, '_token': $('input[name=_token]').val()}, function(data) {
              /*optional stuff to do after success */
               $('#tasks').load(location.href + ' #datatodisplay');
             console.log(data);
            });

          });
 });
</script>