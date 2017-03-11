<?php
    
    function roleTrd($role)
    {

       switch ($role) {
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
                echo 'Ninguno';
                break;
        }

    }