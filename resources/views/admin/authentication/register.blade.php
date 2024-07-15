<div class="modal fade bd-example-modal-lg" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="registerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Register</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <form class="needs-validation" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card-body">
                        
                        <div class="row g-3 py-2">
                            <div class="col-md-6">
                                <label class="form-label" for="nama">Nama</label>
                                <input class="form-control @error('nama') is-invalid @enderror" id="nama" type="text" name="nama" value="{{ old('nama') }}" autocomplete="off"/>

                                @error('nama')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="no_wa">No Whatsapp</label>
                                <input class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" type="text" placeholder="08********" name="no_wa" value="{{ old('no_wa') }}" autocomplete="off"/>

                                @error('no_wa')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row g-3 py-2">
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="off"/>

                                @error('email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="alamat">Alamat</label>
                                <input class="form-control @error('alamat') is-invalid @enderror" id="alamat" type="text" name="alamat" value="{{ old('alamat') }}" autocomplete="off"/>

                                @error('alamat')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 py-2">
                            <div class="col-md-6">
                                <label class="form-label" for="perusahaan">Perusahaan <span class="text-danger">*optional</span></label>
                                <input class="form-control @error('perusahaan') is-invalid @enderror" id="perusahaan" type="text" name="perusahaan" value="{{ old('perusahaan') }}" autocomplete="off"/>

                                @error('perusahaan')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 py-2">
                            <div class="col-md-2 d-flex align-items-end">
                                <div class="form-check">
                                    <input class="form-check-input" id="addUser" type="checkbox" name="addUser" />
                                    <label class="form-check-label" for="addUser">Tambahkan user</label>
                                </div>
                            </div>

                            <div class="col-md-5" id="usernameField" style="display:none">
                                <label class="form-label" for="username">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" id="username" type="text" name="username" value="{{ old('username') }}" />

                                @error('username')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-5" id="passwordField" style="display:none">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" id="password" type="password" name="password" />

                                @error('password')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                        <a href="{{ route('customers.index') }}" class="btn btn-light">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>