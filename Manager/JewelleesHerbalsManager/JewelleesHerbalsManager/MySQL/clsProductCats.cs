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
    class ProductCats
    {
        public int Id
        {
            get;
            private set;
        }

        public String Name
        {
            get;
            private set;
        }

        public String Description
        {
            get;
            private set;
        }
        

        public ProductCats(MySqlDataReader reader)
        {
            this.Id = reader.GetInt32("id");
            this.Name = reader.GetString("category_name");
            this.Description = reader.GetString("description");            
        }
    }
}