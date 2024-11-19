<div class="row mb-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between flex-column flex-md-row text-center text-md-start">
            <h4 class="mb-2 mb-md-0 font-size-20 font-md-size-24 text-primary">{{ $title }}</h4>

            <div class="page-title-right mt-2 mt-md-0">
                <ol class="breadcrumb m-0 d-flex align-items-center justify-content-center justify-content-md-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-muted">{{ $li_1 }}</a></li>
                    @if(isset($title))
                        <li class="breadcrumb-item active text-muted" aria-current="page">{{ $title }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>
