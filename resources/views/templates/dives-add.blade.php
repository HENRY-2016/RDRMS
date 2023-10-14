<div class="my-grid-container" >
    <div class="my-grid-item">
        <input class="text-input-fields" type="text"  value="{{session('user')}}"  autocomplete="off" required="required" readonly>
    </div>

    

    <div class="my-grid-item ">
        <input class="text-input-fields" type="text"  id="add-DiveNo" name="DiveNo" autocomplete="off" required="required" placeholder="Dive Number">
    </div>


    <div class="my-grid-item ">
        <input class="text-input-fields" type="text"  id="add-Location" name="Location" autocomplete="off" required="required" placeholder="Location">
    </div>



    <div class="my-grid-item ">
        <input class="text-input-fields" type="text"  id="add-Site" name="Site" autocomplete="off" required="required" placeholder="Site">
    </div>

    <div class="my-grid-item ">
        <p class="black-modal-text input-labels" >Date</p>
        <input class="text-input-fields" type="date"  id="add-Date" name="Date" autocomplete="off" required="required" placeholder="Date">
    </div>

    <div class="my-grid-item ">
        <p class="black-modal-text input-labels" >Time In</p>
        <input class="text-input-fields-time" type="time"  id="add-TimeIn" name="TimeIn" autocomplete="off" required="required" placeholder="Time In">
    </div>

    <div class="my-grid-item ">
        <p class="black-modal-text input-labels" >Time Out</p>
        <input class="text-input-fields-time" type="time"  id="add-TimeOut" name="TimeOut" autocomplete="off" required="required" placeholder="Time Out">
    </div>

    <div class="my-grid-item ">
        <p class="black-modal-text input-labels" >Instructor</p>
        <select class="text-input-fields-time" type="text"  id="add-Instructor" name="Instructor" autocomplete="off" required="required" placeholder="Instructor">
            <option></option>
            @foreach($instructors as $name)
                <option value="{{$name->id}}">{{GeneralHelper::getInstructorName($name->id)}}</option>
            @endforeach
        </select>
        
    </div>

    <div class="my-grid-item ">
        <input class="text-input-fields" type="text"  id="add-Depth" name="Depth" autocomplete="off" required="required" placeholder="Depth">
    </div>

    <div class="my-grid-item ">
        <select class="text-input-fields" type="text"  id="add-Equipments"  name="Equipments" autocomplete="off" required="required" placeholder="Equipments">
            @foreach ($equipments as $name)
            <option value="{{$name->id}}">{{GeneralHelper::getEquipmentsName($name->id)}}</option>
            @endforeach
        </select>
    </div>
    <div class="my-grid-item ">
    <button type="submit" class="btn btn-primary">Save Dive</button> 
    </div>
</div>