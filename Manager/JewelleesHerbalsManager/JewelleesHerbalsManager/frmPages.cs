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
    delegate void DelegateVoid();

    public partial class frmPages : Form
    {
        Dictionary<int, Pages> pages;
        public frmPages()
        {
            bool notExisting = false;
            Mutex mutex = new Mutex(true, "PageManager", out notExisting);
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
            pages = new Dictionary<int, Pages>();
        }
        private void SelectAll(object sender, System.Windows.Forms.KeyPressEventArgs e)
        {
            if (e.KeyChar == '\x1')
            {
                ((TextBox)sender).SelectAll();
                e.Handled = true;
            }

        }
        public void PagesList()
        {
            lsvPages.Items.Clear();
            pages.Clear();
            AsyncMysqlQuery query = new AsyncMysqlQuery("CALL sp_GetPages();");

            query.SetHandler(delegate(MySqlDataReader reader)
            {
                if (query.Error == null)
                {                    
                    while (reader.Read())
                    {
                        Pages page = new Pages(reader);

                        ListViewItem lsvItem = new ListViewItem(page.Title);
                        lsvItem.Tag = page.Id.ToString();

                        pages.Add(page.Id, page);
                        lsvPages.Invoke(new DelegateVoid(delegate()
                        {
                            lsvPages.Items.Add(lsvItem);
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
        public void ClearPage()
        {
            txtTitle.Text = "";
            txtLinkTitle.Text = "";
            txtPageType.Text = "";
            txtContent.Text = "";
        }

        private void frmPages_Load(object sender, EventArgs e)
        {
            Database.Startup();
            this.FormClosed += new FormClosedEventHandler(frmPages_FormClosed);            
            PagesList();      
        }
        private void frmPages_FormClosed(object sender, FormClosedEventArgs e)
        {
            Database.Shutdown();
        }
        private void lsvPages_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            if (lsvPages.SelectedItems.Count <= 0)
            {
                return;
            }

            int clickedId = int.Parse(lsvPages.SelectedItems[0].Tag.ToString());

            if (pages.ContainsKey(clickedId))
            {
                Pages clickedPage = pages[clickedId];
                txtTitle.Text = clickedPage.Title;
                txtLinkTitle.Text = clickedPage.LinkTitle;                
                txtPageType.Text = clickedPage.PageType;
                txtContent.Text = clickedPage.Content;               
            }
            else
            {
                MessageBox.Show("Dunno that account", "O_o");
            }
            
        }

        private void btnUpdate_Click(object sender, EventArgs e)
        {

        }

        private void btnAdd_Click(object sender, EventArgs e)
        {
        }

        private void btnReset_Click(object sender, EventArgs e)
        {
            ClearPage();
        }

        private void deletePageToolStripMenuItem_Click(object sender, EventArgs e)
        {
           
        }

        private void reloadListToolStripMenuItem_Click(object sender, EventArgs e)
        {
            ClearPage();
            PagesList();
        }

        
    }
}
