<?php
    function add_binhluan($noidung, $iduser, $idpro, $ngaybinhluan)
    {
        $sql = "INSERT INTO `duanmau`.`binhluan` (`noidung`, `iduser`, `idpro`, `ngaybinhluan`)  VALUE ('$noidung', $iduser, $idpro, '$ngaybinhluan')";
        pdo_execute($sql);
    }

    function get_binhluan($idpro)
    {
        $sql = "SELECT binhluan.noidung, binhluan.ngaybinhluan, taikhoan.`user` FROM binhluan INNER JOIN taikhoan ON binhluan.iduser = taikhoan.id WHERE binhluan.idpro = $idpro";
        $listbinhluan = pdo_query($sql);

        return $listbinhluan;
    }
