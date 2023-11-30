    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">PR# {{ $pr->id }}</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text     value="{{ $pr->summary }}"/>
                    <x-show.my-badge    value="{{ $pr->auth_status }}" label="Auth Status"/>
                    <x-show.my-badge    value="{{ $pr->status }}" label="Status"/>
                    <x-show.my-amount   value="{{ $pr->amount }}"/>
                    <x-show.my-text     value="{{ $pr->relRequestor->name }}" label="Requestor"/>
                    <x-show.my-date     value="{{ $pr->pr_date }}"/>
                    <div class="row">
                        <div class="col-sm-3 text-end">
                            
                        </div>
                        <div class="col-sm-9 text-end">
                            <x-show.my-edit-link object="Pr" :id="$pr->id"/>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- end col-8 -->
        
    </div>
    <!-- end row -->

    <script type="text/javascript">
        function mySubmit() {
            //alert('I am inside 2');
            //document.getElementById('upload').click();
            document.getElementById('frm1').submit();
        }
    </script>
