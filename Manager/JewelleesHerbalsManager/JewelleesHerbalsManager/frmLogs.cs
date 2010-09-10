using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using MysqlLib.Command;
using JewelleesHerbalsManager.MySQL;
using System.Threading;

namespace JewelleesHerbalsManager
{
    //delegate void DelegateVoid();
    public partial class frmLogs : Form
    {
        Dictionary<int, Logs> logs;
        public frmLogs()
        {
            bool notExisting = false;
            Mutex mutex = new Mutex(true, "LogManager", out notExisting);
            if (notExisting)
            {
                InitializeComponent();
            }
            else
            {
                MessageBox.Show("Another instance is already running");
                this.Close();
            }

            GC.KeepAlive(mutex);
            logs = new Dictionary<int, Logs>();
        }
        public void LogsList()
        {
            lsvLogs.Items.Clear();
            logs.Clear();
            AsyncMysqlQuery query = new AsyncMysqlQuery("SELECT * FROM sitelog;");

            query.SetHandler(delegate(MySqlDataReader reader)
            {
                if (query.Error == null)
                {
                    while (reader.Read())
                    {
                        Logs log = new Logs(reader);

                        ListViewItem lsvItem = new ListViewItem(log.IP);
                        lsvItem.SubItems.Add(log.LastUpdate);
                        lsvItem.Tag = log.Id.ToString();

                        logs.Add(log.Id, log);
                        lsvLogs.Invoke(new DelegateVoid(delegate()
                        {
                            lsvLogs.Items.Add(lsvItem);
                        }));
                    }
                }
                else
                {
                    MessageBox.Show("something went wrong");
                }
            });
            Database.Herbals.ExecuteSync(query);
        }
        private void frmLogs_Load(object sender, EventArgs e)
        {
            Database.Startup();
            this.FormClosed += new FormClosedEventHandler(frmLogs_FormClosed); 
            LogsList();
        }

        private void frmLogs_FormClosed(object sender, FormClosedEventArgs e)
        {
            Database.Shutdown();
        }
    }
}
