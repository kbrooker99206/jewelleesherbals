using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Text;
using System.Windows.Forms;
using Microsoft.Win32;
using System.Diagnostics;
using MySql.Data.MySqlClient;

namespace JewelleesHerbalsManager
{
    public partial class frmMain : Form
    {
        public frmMain()
        {
            InitializeComponent();
        }
        private void frmMain_Load(object sender, EventArgs e)
        {
           
        }
        private void pageEditorToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Cursor = Cursors.WaitCursor;
            frmPages fPages = new frmPages();
            fPages.MdiParent = this;
            fPages.Show();
            Cursor = Cursors.Default;
        }

        private void contactSubmissionsToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Cursor = Cursors.WaitCursor;
            frmSubmissions fSubmissions = new frmSubmissions();
            fSubmissions.MdiParent = this;
            fSubmissions.Show();
            Cursor = Cursors.Default;
        }

        private void productEditorToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Cursor = Cursors.WaitCursor;
            frmProducts fProducts = new frmProducts();
            fProducts.MdiParent = this;
            fProducts.Show();
            Cursor = Cursors.Default;
        }

        private void clientsToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Cursor = Cursors.WaitCursor;
            frmClients fClient = new frmClients();
            fClient.MdiParent = this;
            fClient.Show();
            Cursor = Cursors.Default;
        }
    }
}
