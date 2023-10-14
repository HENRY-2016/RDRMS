<div class="my-grid-container" >
    <div class="my-grid-item">
        <input class="text-input-fields" type="text"  id="add-FName" name="FName" autocomplete="off" required="required" placeholder="FName">
    </div>

    <div class="my-grid-item ">
        <input class="text-input-fields" type="text"  id="add-LName" name="LName" autocomplete="off" required="required" placeholder="LName">
    </div>

    <div class="my-grid-item ">
        <input class="text-input-fields" type="text"  id="add-Contact" name="Contact" autocomplete="off" required="required" placeholder="Contact">
    </div>

    <div class="my-grid-item ">
        <select class="text-input-fields" type="text"  id="add-Gender" name="Gender" autocomplete="off" required="required" placeholder="Gender">
            <option > Gender</option>
            <option > </option>
            <option value="Male"> Male</option>
            <option value="FeMale"> Female</option>
        </select>
    </div>

    <div class="my-grid-item ">
        <input class="text-input-fields" type="text"  id="add-StudentId" name="StudentId" autocomplete="off" required="required" placeholder="StudentId">
    </div>

    <div class="my-grid-item ">
        <input class="text-input-fields" type="text"  id="add-Address" name="Address" autocomplete="off" required="required" placeholder="Address">
    </div>

    <div class="my-grid-item ">
        <select class="text-input-fields" type="text" onchange="getCourseAmount()"  id="CourseName" name="Course" autocomplete="off" required="required" placeholder="Course">
            <option>Course Name</option>
            <option></option>
            @foreach($courses as $name)
                <option value="{{$name->Name}}">{{$name->Name}}</option>
            @endforeach
        </select>
    </div>

    <div class="my-grid-item ">
        <input class="text-input-fields" type="text"  id="CourseCost" name="EntryYear"  placeholder="Course Price">
    </div>

    <div class="my-grid-item ">
        <input class="text-input-fields" type="text"  id="add-UserName" name="UserName" autocomplete="off" required="required" placeholder="UserName">
    </div>

    <div class="my-grid-item ">
        <input  class="text-input-fields" type="password" id="add-Password" name="Password" autocomplete="off" required="required" placeholder="Password" name="Password">
    </div>


    <!-- <div class="my-grid-item ">
        <input type="file"  name="image" />
    </div> -->
    <div class="my-grid-item ">
    <button type="submit" class="btn btn-primary">Save Data</button> 
    </div>
</div>