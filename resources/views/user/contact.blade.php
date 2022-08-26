@extends('layouts.user')
@section('content')


        <div id="clientcontact">
            <form action="subquery" method="post" id="contact_form" >
                @csrf
                
                <fieldset>
                    <legend style="float:right">Contact Us:</legend>
                    <p>Ask any questions or queries you may have and you will receive a response in the next 24-48hrs.</p>
                    <label for="Query" class="contactlabels">Questions/Suggestions:</label>
                    <textarea name="subquest" rows="7" max-width="100%" class="contactinputs" placeholder="Enter any query you may have (Optional)">
                    </textarea><br><br>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </fieldset> 
            </form>
        </div>
        <div id="aboutlogo"> 
            <img src="/staticimg/sienslogo2.png/" class="pagelogo" alt="logo" height="30%" width="40%">
        </div>
@endsection
