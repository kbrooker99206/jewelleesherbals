using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

using JewelleesMySQL;

namespace JewelleesHerbalsManager
{
    public partial class frmSubmissions : Form
    {

        public frmSubmissions()
        {
            InitializeComponent();
        }
        public void SubmissionsList()
        {
            
        }
        public void ClearSubmission()
        {
            txtName.Text = "";
            txtPhone.Text = "";
            txtEmail.Text = "";
            txtInquiry.Text = "";
            txtNotes.Text = "";
        }
        private void frmSubmissions_Load(object sender, EventArgs e)
        {
            SubmissionsList();
        }

        private void lsvSubmissions_MouseDoubleClick(object sender, MouseEventArgs e)
        {
           
        }

        private void btnUpdate_Click(object sender, EventArgs e)
        {
            
        }

        private void btnReset_Click(object sender, EventArgs e)
        {
            ClearSubmission();
        }

        private void deleteSubmissionToolStripMenuItem_Click(object sender, EventArgs e)
        {

        }

        private void reloadListToolStripMenuItem_Click(object sender, EventArgs e)
        {
            ClearSubmission();
            SubmissionsList();
        }
    }
}
