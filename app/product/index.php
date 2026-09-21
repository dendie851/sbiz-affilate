<?php ob_start(); ?>
    <?php include_once 'indexRead.php' ?>


    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                                      
                        <h4 class="font-weight-bold py-3 mb-0">Product</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item">Product</li>
                            </ol>
                        </div>                               
                  </div>
            </div>      

            <?php if(isset($_GET['msg'])): ?>    
                <?php if($_GET['msg'] == 'addSuccess'): ?>    
                    <div class="alert alert-dark-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Data berhasil disimpan
                    </div>   
                <?php endif; ?>    
                <?php if($_GET['msg'] == 'editSuccess'): ?>    
                    <div class="alert alert-dark-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Data berhasil simpan
                    </div>   
                <?php endif; ?>    
                <?php if($_GET['msg'] == 'deleteSuccess'): ?>    
                    <div class="alert alert-dark-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Data berhasil dihapus
                    </div>   
                <?php endif; ?>                                    
            <?php endif; ?>

            <?php if(mysqli_num_rows($data) < 1) : ?>
                    <div class="alert alert-dark-warning alert-dismissible fade show">
                        Belum ada data 
                    </div>   
            <?php else: ?>    
                <div class="card">
                    <div class="card-datatable table-responsive" style="padding: 20px 10px 10px 10px">
                    <table  id="datatables" class="table table-striped table-bordered" data-toolbar="#bootstrap-table-toolbar" data-search="true" data-show-columns="true" data-show-export="true" data-detail-view="false" data-minimum-count-columns="3"
                        data-show-pagination-switch="false" data-pagination="true" data-id-field="id" >
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center"><b>NO</b></th>
                                <th width="20%" style="text-align: center"><b>PRODUK</b></th>
                                <th width="10%" style="text-align: center"><b>KOMISI</b></th>
                                <th width="35%" style="text-align: center"><b>LINK REFERRAL</b></th>  
                                <th width="" style="text-align: center"><b>LINK BROSUR PRODUK</b></th>                               
                            </tr>                                               
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php while($val = $data->fetch_array()): ?>
                                <tr style="cursor: pointer;">
                                     <td>
                                        <?php echo $i ?>                 
                                    </td> 
                                    <td>
                                        <?php echo $val['name'] ?>                 
                                    </td>            
                                    <td>              
                                        <?php echo $val['name'] ?>  
                                    </td>
                                    <td align="center">          
                                        <?php $linkUrlLinkRefferal = $affiliateSetting.'/'.$val['username'].'/'.$val['affiliate_stuff_id'] ?>    
                                        <a href="<?php echo $linkUrlLinkRefferal ?>" target="_blank">
                                            <?php echo $linkUrlLinkRefferal ?>
                                        </a>
                                        
                                        <button type="button" class="btn btn-sm btn-outline-primary ml-2" onclick="copyToClipboard('<?php echo $linkUrlLinkRefferal ?>')">
                                            <i class="fa fa-copy"></i> Copy
                                        </button>
                                    </td>
                                    <td>      
                                        <?php $link_product_brosur = $val['link_product_brosur'] ?>
                                        <a href="<?php $link_product_brosur ?>" target="_blank">
                                            <?php echo $link_product_brosur ?> 
                                        </a>  
                                        
                                         <button type="button" class="btn btn-sm btn-outline-primary ml-2" onclick="copyToClipboard('<?php echo $link_product_brosur ?>')">
                                            <i class="fa fa-copy"></i> Copy
                                        </button>                                       
                                    </td>                                    
                                    <td> 
                                        
                                    </td>                                                                       
                                </tr>
                            <?php $i++ ?>    
                            <?php endwhile; ?>                          
                        </tbody>
                    </table>
                    </div>
                </div>
            <?php endif; ?>    
        </div>    
    </div>     

   
<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            lengthMenu: [
                [ 50, 100, 200, -1 ],
                [ '50 Data', '100 Data', '200 Data', 'Tampilkan Semua' ]
            ], 
        }               
        );
    });  

    function deleteConfirm(p) {
      bootbox.confirm({
        message: 'Anda yakin akan menghapus ?',
        className: 'bootbox-xs',

        callback: function(result) {
            if(result) {
                window.location='<?php echo $globalUrl ?>employee/delete?id='+p;
            }    
        },
      });
    }          


    function copyToClipboard(text) {
        // Cek apakah browser mendukung Clipboard API yang modern dan berjalan di HTTPS (Secure Context)
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(function() {
                alert("Tautan berhasil disalin: " + text);
            }).catch(function(err) {
                console.error("Gagal menyalin: ", err);
                alert("Gagal menyalin tautan.");
            });
        } else {
            // Fallback (Cadangan) menggunakan cara lama untuk browser lama / HTTP
            var tempInput = document.createElement("input");
            tempInput.style.position = "absolute";
            tempInput.style.left = "-1000px";
            tempInput.style.top = "-1000px";
            tempInput.value = text;
            
            document.body.appendChild(tempInput);
            tempInput.select();
            
            try {
                document.execCommand("copy");
                alert("Tautan berhasil disalin: " + text);
            } catch (err) {
                console.error("Gagal menyalin: ", err);
                alert("Gagal menyalin tautan.");
            }
            
            document.body.removeChild(tempInput);
        }
    }


    function copyToClipboard(text) {
            // Cek apakah browser mendukung Clipboard API yang modern dan berjalan di HTTPS (Secure Context)
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(function() {
                    alert("Tautan berhasil disalin: " + text);
                }).catch(function(err) {
                    console.error("Gagal menyalin: ", err);
                    alert("Gagal menyalin tautan.");
                });
            } else {
                // Fallback (Cadangan) menggunakan cara lama untuk browser lama / HTTP
                var tempInput = document.createElement("input");
                tempInput.style.position = "absolute";
                tempInput.style.left = "-1000px";
                tempInput.style.top = "-1000px";
                tempInput.value = text;
                
                document.body.appendChild(tempInput);
                tempInput.select();
                
                try {
                    document.execCommand("copy");
                    alert("Tautan berhasil disalin: " + text);
                } catch (err) {
                    console.error("Gagal menyalin: ", err);
                    alert("Gagal menyalin tautan.");
                }
                
                document.body.removeChild(tempInput);
            }
    }  
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>


<?php include_once 'app/template/main.php' ?>
