<?php
    
     if(isset($_GET['status'])){
        if($_GET['status'] == 'added'){
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Success!</strong> '.$msg.' berhasil ditambahkan!
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>';
        }else if($_GET['status'] == 'failed'){
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Failed!</strong> '.$msg.' gagal diubah!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
        }else if($_GET['status'] == 'updated'){
            $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> '.$msg.' berhasil diubah!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
        }else if($_GET['status'] == 'deleted'){
            $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> '.$msg.' berhasil dihapus!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
        }
}
?>