<template>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
   <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Уведомления
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach(auth()->user()->unreadNotifications as $notification)
             <li><a class="dropdown-item" href="#">Action</a></li>
            @endforeach
          </ul>
        </li> 
</ul>
</div>
    
</template>

<script>
    export default {
        mounted() {
            alert('hello');
            
        }
    }
</script>
