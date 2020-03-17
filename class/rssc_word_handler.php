<?php

// $Id: rssc_word_handler.php,v 1.1 2011/12/29 14:37:16 ohwada Exp $

// 2007-11-24 K.OHWADA
// move create_table() to rssc_install.php

//=========================================================
// Rss Center Module
// this file contain 2 class
//   rssc_word
//   rssc_word_handler
// 2007-06-01 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('rssc_word_handler')) {
    //=========================================================
    // class word
    //=========================================================

    /**
     * Class rssc_word
     */
    class rssc_word extends happy_linux_object
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            parent::__construct();

            $this->initVar('sid', XOBJ_DTYPE_INT, null, false);
            $this->initVar('word', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('reg', XOBJ_DTYPE_INT, 0);
            $this->initVar('point', XOBJ_DTYPE_INT, 0);
            $this->initVar('count', XOBJ_DTYPE_INT, 0);
            $this->initVar('aux_int_1', XOBJ_DTYPE_INT, 0);
            $this->initVar('aux_int_2', XOBJ_DTYPE_INT, 0);
            $this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);
        }

        // --- class end ---
    }

    //=========================================================
    // class word handler
    //=========================================================

    /**
     * Class rssc_word_handler
     */
    class rssc_word_handler extends happy_linux_object_handler
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------

        /**
         * rssc_word_handler constructor.
         * @param $dirname
         */
        public function __construct($dirname)
        {
            parent::__construct($dirname, 'word', 'sid', 'rssc_word');

            $this->set_debug_db_sql(RSSC_DEBUG_WORD_SQL);
            $this->set_debug_db_error(RSSC_DEBUG_ERROR);
        }

        //---------------------------------------------------------
        // function
        //---------------------------------------------------------

        /**
         * @param $obj
         * @return string|void
         */
        public function _build_insert_sql($obj)
        {
            foreach ($obj->gets() as $k => $v) {
                ${$k} = $v;
            }

            $sql = 'INSERT INTO ' . $this->_table . ' (';
            $sql .= 'word, ';
            $sql .= 'reg, ';
            $sql .= 'point, ';
            $sql .= 'count, ';
            $sql .= 'aux_int_1, ';
            $sql .= 'aux_int_2, ';
            $sql .= 'aux_text_1, ';
            $sql .= 'aux_text_2 ';
            $sql .= ') VALUES ( ';
            $sql .= $this->quote($word) . ', ';
            $sql .= (int)$reg . ', ';
            $sql .= (int)$point . ', ';
            $sql .= (int)$count . ', ';
            $sql .= (int)$aux_int_1 . ', ';
            $sql .= (int)$aux_int_2 . ', ';
            $sql .= $this->quote($aux_text_1) . ', ';
            $sql .= $this->quote($aux_text_2) . ' ';
            $sql .= ')';

            return $sql;
        }

        /**
         * @param $obj
         * @return string|void
         */
        public function _build_update_sql($obj)
        {
            foreach ($obj->gets() as $k => $v) {
                ${$k} = $v;
            }

            $sql = 'UPDATE ' . $this->_table . ' SET ';
            $sql .= 'word=' . $this->quote($word) . ', ';
            $sql .= 'reg=' . (int)$reg . ', ';
            $sql .= 'point=' . (int)$point . ', ';
            $sql .= 'count=' . (int)$count . ', ';
            $sql .= 'aux_int_1=' . (int)$aux_int_1 . ', ';
            $sql .= 'aux_int_2=' . (int)$aux_int_2 . ', ';
            $sql .= 'aux_text_1=' . $this->quote($aux_text_1) . ', ';
            $sql .= 'aux_text_2=' . $this->quote($aux_text_2) . ' ';
            $sql .= 'WHERE sid=' . (int)$sid;

            return $sql;
        }

        //---------------------------------------------------------
        // get count
        //---------------------------------------------------------

        /**
         * @param $word
         * @return bool
         */
        public function get_count_by_word_search($word)
        {
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria('word', '%' . $word . '%', 'LIKE'));
            $count = $this->getCount($criteria);

            return $count;
        }

        //---------------------------------------------------------
        // get objects
        //---------------------------------------------------------

        /**
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &get_objects_point_asc($limit = 0, $start = 0)
        {
            $sort = 'point ASC, count ASC, sid ASC';
            $criteria = new CriteriaCompo();
            $criteria->setSort($sort);
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = &$this->getObjects($criteria);

            return $objs;
        }

        /**
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &get_objects_point_desc($limit = 0, $start = 0)
        {
            $sort = 'point DESC, count DESC, sid ASC';
            $criteria = new CriteriaCompo();
            $criteria->setSort($sort);
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = &$this->getObjects($criteria);

            return $objs;
        }

        /**
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &get_objects_count_asc($limit = 0, $start = 0)
        {
            $sort = 'count ASC, point ASC, sid ASC';
            $criteria = new CriteriaCompo();
            $criteria->setSort($sort);
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = &$this->getObjects($criteria);

            return $objs;
        }

        /**
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &get_objects_count_desc($limit = 0, $start = 0)
        {
            $sort = 'count DESC, point DESC, sid ASC';
            $criteria = new CriteriaCompo();
            $criteria->setSort($sort);
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = &$this->getObjects($criteria);

            return $objs;
        }

        /**
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &get_objects_word_asc($limit = 0, $start = 0)
        {
            $sort = 'word ASC, sid ASC';
            $criteria = new CriteriaCompo();
            $criteria->setSort($sort);
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = &$this->getObjects($criteria);

            return $objs;
        }

        /**
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &get_objects_word_desc($limit = 0, $start = 0)
        {
            $sort = 'word DESC, sid ASC';
            $criteria = new CriteriaCompo();
            $criteria->setSort($sort);
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = &$this->getObjects($criteria);

            return $objs;
        }

        /**
         * @param     $word
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &get_objects_by_word($word, $limit = 0, $start = 0)
        {
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria('word', $word, '='));
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = &$this->getObjects($criteria);

            return $objs;
        }

        /**
         * @param     $word
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &get_objects_by_word_search($word, $limit = 0, $start = 0)
        {
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria('word', '%' . $word . '%', 'LIKE'));
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = &$this->getObjects($criteria);

            return $objs;
        }

        //---------------------------------------------------------
        // for admin/word_manage.php
        //---------------------------------------------------------

        /**
         * @param $objs
         * @param $script
         * @return string
         */
        public function build_error_list($objs, $script)
        {
            $msg = '<ul>';
            foreach ($objs as $obj) {
                $msg .= $this->_build_error_list_single($obj, $script);
            }
            $msg .= "</ul>\n";

            return $msg;
        }

        /**
         * @param $obj
         * @param $script
         * @return string
         */
        public function _build_error_list_single($obj, $script)
        {
            $sid = $obj->get('sid');
            $sid_s = sprintf('%03d', $sid);
            $url_l = $script . $sid;

            $text = '<li>';
            $text .= '<a href="' . $url_l . '" target="_blank">' . $sid_s . '</a>';
            $text .= "</li>\n";

            return $text;
        }

        // --- class end ---
    }
    // === class end ===
}
