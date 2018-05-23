<?php
if ( !class_exists( 'SmartSession' ) ):
    /**
     * SmartSession
     *
     * Simple session wrapper class in php
     *
     * @author Ohad Raz <admin@bainternet.info>
     * @copyright 2013 Ohad Raz
     * @version 0.1
     */
    class SmartSession{
        /**
         * Class constructor starts the session
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         *
         * @return instance
         */
        function __construct(){
            return $this->start();
        }
        /**
         * start
         *
         * starts the session
         *
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         *
         * @return instance
         */
        public function start(){
            session_start();
            return $this;
        }
        /**
         * set
         *
         * sets a var in global $_SESSION
         *
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         *
         * @param string $name  name of var
         * @param mixed $value value of var
         *
         * @return instance
         */
        function set($name, $value){
            $_SESSION[$name] = $value;
            return $this;
        }
        /**
         * get
         *
         * gets a var from global $_SESSION
         * if name is not found the the def (default value)
         * will be returned or false
         *
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         *
         * @param  string  $name name of var to get
         * @param  mixed $def  default value to return
         *
         * @return mixed
         */
        function get($name ,$def = false){
            if(isset($_SESSION[$name]))
                return $_SESSION[$name];
            else
                return ($def !== false)? $def : false;
        }
        /**
         * del
         *
         * unsets a var in global $_SESSION
         *
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         *
         * @param  string $name name of var to unset
         *
         * @return instance
         */
        function del($name){
            unset($_SESSION[$name]);
            return $this;
        }
        /**
         * destroy
         *
         * destroys the session
         *
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         *
         * @return instance
         */
        function destroy(){
            $_SESSION = array();
            session_destroy();
            return $this;
        }
        /**
         * fromArray
         *
         * sets vars in global $_SESSION from given array
         *
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         * @return instance
         *
         * @param  array $a array to set
         *
         * @return instance
         */
        function fromArray($a=null){
            if( is_array($a) ){
                foreach($a as $k => $v)
                    $this->set($k,$v);
            }
            return $this;
        }
        /**
         * fromObject
         *
         * sets vars in global $_SESSION from given objects properties
         *
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         * @return instance
         *
         * @param  object $a object to set
         *
         * @return instance
         */
        function fromObject($a=null){
            if( is_object( $a ) )
                return $this->fromArray( get_object_vars($a) );

            return $this;
        }
        /***************
         * magic stuff *
         ***************/

        /**
         * __set
         *
         * catches set and calls set method
         *
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         *
         * @param string $name
         * @param mixed $value
         *
         * @return instance
         */
        function __set($name,$value){
            $this->set($name,$value);
            return $this;
        }
        /**
         * __get
         *
         * catches get and calls get method
         *
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         * @return instance
         *
         * @param  string  $name
         * @param  boolean $def
         *
         * @return mixed
         */
        function __get($name,$def = false){
            $this->get($name,$value);
        }
        /**
         * __toString
         *
         * returns print_r version of session array wrapped in pre tag
         *
         * @author Ohad Raz <admin@bainternet.info>
         * @access public
         * @since 0.1
         *
         * @return string session array wrapped in pre tag
         */
        function __toString(){
            return '<pre>'.print_r($_SESSION,true).'</pre>';
        }
    }
endif;