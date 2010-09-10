using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using MysqlLib.Command;

namespace JewelleesHerbalsManager.MySQL
{
    class Logs
    {
        public int Id
        {
            get;
            private set;
        }

        public String IP
        {
            get;
            private set;
        }

        public String LastUpdate
        {
            get;
            private set;
        }
        

        public Logs(MySqlDataReader reader)
        {
            this.Id = reader.GetInt32("id");
            this.IP = reader.GetString("userhost");
            this.LastUpdate = reader.GetString("lastupdate");                   
        }
    }
}
