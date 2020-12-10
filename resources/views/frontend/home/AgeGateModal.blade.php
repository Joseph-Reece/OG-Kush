<div class="modal fade" id="age_gate" tabindex="-1" role="dialog" aria-labelledby="age_gate" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-body ">
                <div class="card">
                    <div class="card-body border-0 ">
                        <div class=" d-flex justify-content-center ">
                            <img style="height: 250px; width: 250px" src="{{asset(setting('logo') ? 'uploads/' . setting('logo') : 'assets/images/assets/logo.png')}}" alt="logo">
                        </div>
                    </div>
                </div>

                    <div class="row justify-content-center" >

                        <h3 style=" margin: 25px 50px 50px 50px;">
                            Are You 18 or Older?
                        </h3>

                    </div>


                <div class="d-flex justify-content-around">
                    <button type="button" class="btn btn-search" id="underage">No Am not</button>
                    <button type="button" class="btn btn-search" id="overage">Yes I am</button>
                </div>
            </div>

            </form>

        </div>
    </div>
</div>
