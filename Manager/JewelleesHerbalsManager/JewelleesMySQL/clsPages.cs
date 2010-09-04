using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using MysqlLib.Command;

namespace ANHAcctMgr
{
    public class Pages
    {
        public int Id
        {
            get;
            private set;
        }

        public String Title
        {
            get;
            private set;
        }

        public String LinkTitle
        {
            get;
            private set;
        }
        public String PageType
        {
            get;
            private set;
        }

        public String Content
        {
            get;
            private set;
        }

        public Pages(MySqlDataReader reader)
        {
            this.Id = reader.GetInt32("id");
            this.Title = reader.GetString("title");
            this.LinkTitle = reader.GetString("linktitle");
            this.PageType = reader.GetString("linktitle");
            this.Content = reader.GetString("content");            
        }
    }
}