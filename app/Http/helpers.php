<?php
    
    function typeTrd($type)
    {
       switch ($type) {
            case 'user':
                echo 'Usuario';
                break;
            case 'admin':
                echo 'Administrador';
                break;
            case 'superadmin':
                echo 'Super Administrador';
                break;

            default:
                echo '';
                break;
        }
    }

    function roleTrd($role)
    {
        switch ($role) {
            case 'seller':
                echo 'Vendedor';
                break;
            case 'none':
                echo '';
                break;
            default:
                echo '';
                break;
        }
    }