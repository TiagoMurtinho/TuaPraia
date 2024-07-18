<div class="modal fade" id="editProfileInfoModal" tabindex="-1" aria-labelledby="editProfileInfoModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileInfoModalLabel">{{ __('profile.edit_profile') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('pages.profile.partials.update-profile-name-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
