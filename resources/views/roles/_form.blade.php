
<div>
    <x-label for="name" :value="__('Name')" />

    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{isset($role) ? old('name',$role['name']):''}}" required />
  </div>
  <br>
  
  <div class="card card-primary">
    <div class="card-header">
      <h2 class="card-title">{{ __('Permissions') }}</h2>
    </div>
    <div class="card-body">
      <div class="row">
        @foreach ($modules as $module)
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header">
                  <div class="card-header">
                    <h5 class="card-title">{{$module['name']}}</h5>
                  </div>
                </div>

                <div class="card-body">
                  @foreach($module['permissions'] as $permission)
                  
                  <div class="row">
                      <div class="col-lg-9">
                          <label for="{{$permission['key']}}">{{$permission['name']}}</label>
                      </div>
                      <div class="col-lg-3">
                        
                          <label class="switch">
                              <input type="checkbox" name="permissions[][permission_id]" value="{{$permission['id']}}"
                                  id="{{$permission['key']}}" >
                              <span class="slider round"></span>
                          </label>
                      </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
        @endforeach
      </div>
    </div>
  </div>


<script defer>
   @if(isset($role))
    @foreach ($role['permissions'] as $role_permissions)
      document.getElementById("{{$role_permissions['permission']['key']}}").checked = true;
    @endforeach
  @endif
</script>
 
 
 
  
