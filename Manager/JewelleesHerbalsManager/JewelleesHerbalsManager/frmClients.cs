using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using MySql.Data.MySqlClient;


namespace JewelleesHerbalsManager
{
    public partial class frmClients : Form
    {

        public frmClients()
        {
            InitializeComponent();
        }

        private void frmClients_Load(object sender, EventArgs e)
        {
            ClientsList();
        }
        public void ClientsList()
        {
            
        }
        public void ClearClient()
        {

        }

        private void lsvClients_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            if (lsvClients.SelectedItems.Count <= 0)
            {
                return;
            }

            
        }

        private void btnUpdate_Click(object sender, EventArgs e)
        {
          
        }

        private void btnAdd_Click(object sender, EventArgs e)
        {
            
        }

        private void deleteClientToolStripMenuItem_Click(object sender, EventArgs e)
        {
            
        }
        
    }
}
