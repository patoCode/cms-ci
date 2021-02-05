<?php
class Usuario_model	extends CI_Model
{ 
     public function checkLogin()
    {
        if(trim($this->input->post('password'))!='' && trim($this->input->post('login'))!='')
        {
            $user = $this->input->post('login');
            $pass = md5($this->input->post('password'));
            $this->db->from('com_usuario');
            $this->db->where('usuario = ', $user);
            $this->db->limit(1);
            echo $this->db->last_query();
            $query = $this->db->get();
            if($query->num_rows() >= 1)
            {
                $login = $query->row();
                $this->db->from('com_usuario');
                $this->db->join('com_cargo', 'com_cargo.id_cargo = com_usuario.id_cargo', 'left');
                $this->db->join('com_funcionario', 'com_funcionario.id_funcionario = com_usuario.id_funcionario', 'left');

                if( strtolower($login->login_local) == "ldap" )
                {
                    $conex = ldap_connect(SERVER_LDAP,PORT_SERVER_LDAP) or die ("No ha sido posible conectarse al servidor");
                    ldap_set_option($conex, LDAP_OPT_PROTOCOL_VERSION, 3);
                    ldap_set_option($conex, LDAP_OPT_REFERRALS, 0);
                    $SW_LDAP = FALSE;
                    if ($conex)
                    {
                        ini_set('display_errors',0);
                        $userldap = $user.COMPANY_DOMAIN;
                        $passldap = $this->input->post('password');
                        $ldapconn = ldap_bind($conex,$userldap,$passldap);
                        if(!$ldapconn)
                            return false;
                    }
                }
                else
                {
                    $this->db->where('password ', $pass);
                }
                $this->db->where('usuario = ', $user);
                $this->db->limit(1);
                $query = $this->db->get();
                return $query->result();
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    public function getUsuarioByPass($pass)
    {
        $this->db->from('com_usuario');
        $this->db->where('password', $pass);
        $query = $this->db->get();
        return $query;
    }
}