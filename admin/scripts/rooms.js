
        let add_room_form = document.getElementById('add_room_form');
        add_room_form.addEventListener('submit', function(e){
            e.preventDefault();
            edit_room();
        });
        
        let edit_room_form = document.getElementById('edit_room_form');
        edit_room_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_room();
        });

        let add_image_form = document.getElementById('add_image_form');
        add_image_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_image();
        });

        function add_room(){
            let data=new FormData();
            data.append('add_room','');
            data.append('name',add_room_form.elements['name'].value);
            data.append('area',add_room_form.elements['area'].value);
            data.append('price',add_room_form.elements['price'].value);
            data.append('quantity',add_room_form.elements['quantity'].value);
            data.append('adults',add_room_form.elements['adults'].value);
            data.append('children',add_room_form.elements['children'].value);
            
            let features=[];
            add_room_form.elements['features'].forEach(el => {
                if(el.checked){
                    features.push(el.value);
                }
            });
            let facilities=[];
            add_room_form.elements['facilities'].forEach(el => {
                if(el.checked){
                    facilities.push(el.value);
                }
            });

            
            data.append('features',JSON.stringify(features));
            data.append('facilities',JSON.stringify(facilities));

            let xhr= new XMLHttpRequest();
            xhr.open('POST', "ajax/rooms.php", true);

            xhr.onload =function(){
                    var myModal = document.getElementById('add-room');
                    var modal = bootstrap.Modal.getInstance(myModal);
                    modal.hide();

                    if(this.responseText == 1){
                        alert('success', 'New room added!');
                        add_room_form.reset();
                        get_all_rooms();
                    }
                    else{
                        alert('error', 'Server Down!');
                    }
                }

            xhr.send(data);
        }
        
        function get_all_rooms(){
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/rooms.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function(){
                    document.getElementById('room-data').innerHTML = this.responseText;
                }

                xhr.send('get_all_rooms');
            }

        function toggle_status(id,val){
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/rooms.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function(){
                     if(this.responseText == 1){
                        alert('success', 'Status changed!');
                        get_all_rooms();
                    }
                    else{
                        alert('error', 'Server Down!');
                    }
                }
                xhr.send('toggle_status='+id+'&value'+val);
            }

        function edit_room(id){
            let xhr= new XMLHttpRequest();
            xhr.open('POST', "ajax/rooms.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload =function(){
                xhr.onload = function() {
                let data = JSON.parse(this.responseText);

                edit_room_form.elements['name'].value = data.roomdata.name;
                edit_room_form.elements['area'].value = data.roomdata.area;
                edit_room_form.elements['price'].value = data.roomdata.price;
                edit_room_form.elements['quantity'].value = data.roomdata.quantity;
                edit_room_form.elements['adults'].value = data.roomdata.aduls;
                edit_room_form.elements['children'].value = data.roomdata.children;
                edit_room_form.elements['room_id'].value = data.roomdata.id;

                    
                    edit_room_form.elements['features'].forEach(el => {
                        if(data.features.includes(Number(el.value))){
                            el.checked=true;
                        }
                    });
                    edit_room_form.elements['facilities'].forEach(el => {
                        if(data.facilities.includes(el.value)){
                            el.checked=true;
                        }
                    });
            }                 
            }
            xhr.send('get_room'+id)
        }

        function add_edit_room(){
            let data=new FormData();
            data.append('edit_room','');
            data.append('room_id',add_edit_room.elements['room_id'].value);
            data.append('name',add_edit_room.elements['name'].value);
            data.append('area',add_edit_room.elements['area'].value);
            data.append('price',add_edit_room.elements['price'].value);
            data.append('quantity',add_edit_room.elements['quantity'].value);
            data.append('adults',add_edit_room.elements['adults'].value);
            data.append('children',add_edit_room.elements['children'].value);
            
            let features=[];
            add_edit_room.elements['features'].forEach(el => {
                if(el.checked){
                    features.push(el.value);
                }
            });
            let facilities=[];
            add_edit_room.elements['facilities'].forEach(el => {
                if(el.checked){
                    facilities.push(el.value);
                }
            });

            data.append('features',JSON.stringify(features));
            data.append('facilities',JSON.stringify(facilities));

            let xhr= new XMLHttpRequest();
            xhr.open('POST', "ajax/rooms.php", true);

            xhr.onload =function(){
                    var myModal = document.getElementById('add-room');
                    var modal = bootstrap.Modal.getInstance(myModal);
                    modal.hide();

                    if(this.responseText == 1){
                        alert('success', 'Room edited!');
                        add_edit_room.reset();
                        get_all_rooms();
                    }
                    else{
                        alert('error', 'Server Down!');
                    }
                }

            xhr.send(data);
        }

        function add_image(){
            let data = new FormData();
            data.append('image', add_image_form.elements['image'].files[0]);
            data.append('room_id', add_image_form.elements['room_id'].value);
            data.append('add_image', '');
            
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function()
            {
                if (this.responseText == 'inv_img') {
                    alert('error', 'Only JPG, WEBP or PNG images are allowed!');
                } else if (this.responseText == 'inv_size') {
                    alert('error', 'Image should be less than 2MB!');
                } else if (this.responseText == 'upd_failed') {
                    alert('error', 'Image upload failed. Server Down!');
                }else{
                    alert('success', 'Image uploaded!', 'image-alert');
                    room_image(add_image_form.elements['room_id'].value, document.querySelector("#room-image .modal-title").innerText);
                    add_image_form.reset();
                }
            }
            xhr.send(data);
        }

        function room_image(id, rname){
            document.querySelector("#room-image .modal-title").innerText = rname;
            add_image_form.elements['room_id'].value=id;
            add_image_form.elements['image'].value='';
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
              xhr.onload = function(){
                     document.getElementById('room-image-data').innerHTML= this.responseText;              }
            xhr.send('get_room_images='+id);
        }

        function rem_image(img_id,room_id)
        {
        let data = new FormData();
        data.append('image_id',img_id);
        data.append('room_id',room_id);
        data.append('rem_image','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/rooms.php",true);

        xhr.onload = function()
        {
            if(this.responseText == 1){
                alert('success','Image Removed!','image-alert');
                room_images(room_id,document.querySelector("#room-images .modal-title").innerText);
            }
            else{
                alert('error','Image removal failed!','image-alert');
            }
        }
        xhr.send(data);
        }

        function rem_room(room_id)
        {
            if(confirm("Are you sure, you want to delete this room?"))
            {
                let data = new FormData();
                data.append('room_id',room_id);
                data.append('remove_room','');
            
                let xhr = new XMLHttpRequest();
                xhr.open("POST","ajax/rooms.php",true);

                xhr.onload = function()
                {
                    if(this.responseText == 1){
                        alert('success','Room Removed!');
                        get_all_rooms();
                    }
                    else{
                        alert('error','Room removal failed!');
                    }
                }
                xhr.send(data);
            }
        }

        window.onload = function(){
            get_all_rooms();
        }
