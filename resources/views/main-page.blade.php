@extends('index')

@section('title', 'Main page')

@section('main')
  <div class="container-fluid p-0">
    <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3303.7617232960456!2d-118.34587228444182!3d34.1012440805926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf20e4c82873%3A0x14015754d926dadb!2s7060%20Hollywood%20Blvd%2C%20Los%20Angeles%2C%20CA%2090028%2C%20USA!5e0!3m2!1sen!2sua!4v1606913727917!5m2!1sen!2sua" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  </div>
<wizard-form 
  csrf="{{csrf_token()}}" 
  members-amount = "{{$membersAmount}}"
  upload-max-filesize="{{$uploadMaxFilesize}}"
  twit-message = "{{$twitMessage}}"
  facebook-url = "{{$facebookUrl}}"
></wizard-form>
@endsection