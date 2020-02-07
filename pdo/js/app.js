$(document).ready(function(){
    
    $("#create-task").submit(function(event){
        event.preventDefault();
        
        
        var form = $(this);
        
        
        var formData = form.serialize();
        
        
        $("#name_error").html("");
        $("#description_error").html("");
        
        $.ajax({
            url:"create.php",
            method: 'POST',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function(data){
                
//                alert(data.message.name);
               
                if(data.success = 'false'){
                    
                    if(data.message.name != ""){
                        $("#name_error").css("display","block").html(data.message.name);
//                        alert("Error name!");
                    }
                    
                    if(data.message.description != ""){
                         $("#description_error").css("display","block").html(data.message.description);
//                        alert("Error description!");
                    }
                }else{
                    $("#ajax_msg").css("display","block").delay(3000).slideUp(300).html(data.message);
                    document.getElementById("create-task").reset();
                }
            }
            
        });
        
        
        
        
//        var name = $("#name").val();
//        var description = $("#description").val();
        
        
//        console.log(name + " - " + description);
        
        
        
    });
    
//    $("#task-list").load('read.php');
    
});

function makeElementEditable(div){
    div.style.border = "1px solid lavender";
    div.style.padding = "5px";
    div.style.background = "white";
    div.contentEditable = true;
}




function updateTaskValue(target, taskid, columnName){
    //var mydata = target.textContent;
    var mydata = target.textContent;
    
    target.style.border = "none";
    target.style.padding = "0px";
    target.style.background = "#ececec";
    target.contentEditable = false;
    
//    alert(data);
    
    $.ajax({
            url:"update.php",
            method: 'POST',
            data: {data: mydata, id: taskid, column: columnName},
            success: function(mydata){
                $("#ajax_msg").css("display","block").delay(3000).slideUp(300).html(mydata);
                
            }
            
        });
    
    
}

function updateTaskName(target,taskid){
    updateTaskValue(target,taskid,"name");
}

function updateTaskDescription(target, taskid){
    updateTaskValue(target,taskid,"description");
}

function updateTaskStatus(target, taskid){
    updateTaskValue(target,taskid,"status");
}


function deleteTask(taskid){
    if(confirm("Do you rally want to delete this task?")){
        
        $.ajax({
            url:"delete.php",
            method: 'POST',
            data: {id: taskid},
            success: function(data){
                $("#ajax_msg").css("display","block").delay(3000).slideUp(300).html(data);
                
                
                
            }
            
        });
        
//        $("#task-list").load("read.php");
        window.location.replace('tasks.php?p=1');
    
        
        
    }
    
    return false;
}