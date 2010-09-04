namespace JewelleesHerbalsManager
{
    partial class frmPages
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            this.btnReset = new System.Windows.Forms.Button();
            this.btnAdd = new System.Windows.Forms.Button();
            this.btnUpdate = new System.Windows.Forms.Button();
            this.label3 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.txtContent = new System.Windows.Forms.TextBox();
            this.txtPageType = new System.Windows.Forms.TextBox();
            this.txtTitle = new System.Windows.Forms.TextBox();
            this.lsvPages = new System.Windows.Forms.ListView();
            this.columnHeader1 = ((System.Windows.Forms.ColumnHeader)(new System.Windows.Forms.ColumnHeader()));
            this.contextMenuStrip1 = new System.Windows.Forms.ContextMenuStrip(this.components);
            this.deletePageToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.reloadListToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.label4 = new System.Windows.Forms.Label();
            this.txtLinkTitle = new System.Windows.Forms.TextBox();
            this.contextMenuStrip1.SuspendLayout();
            this.SuspendLayout();
            // 
            // btnReset
            // 
            this.btnReset.Location = new System.Drawing.Point(274, 387);
            this.btnReset.Name = "btnReset";
            this.btnReset.Size = new System.Drawing.Size(340, 23);
            this.btnReset.TabIndex = 33;
            this.btnReset.Text = "Reset";
            this.btnReset.UseVisualStyleBackColor = true;
            this.btnReset.Click += new System.EventHandler(this.btnReset_Click);
            // 
            // btnAdd
            // 
            this.btnAdd.Location = new System.Drawing.Point(274, 358);
            this.btnAdd.Name = "btnAdd";
            this.btnAdd.Size = new System.Drawing.Size(340, 23);
            this.btnAdd.TabIndex = 32;
            this.btnAdd.Text = "Add";
            this.btnAdd.UseVisualStyleBackColor = true;
            this.btnAdd.Click += new System.EventHandler(this.btnAdd_Click);
            // 
            // btnUpdate
            // 
            this.btnUpdate.Location = new System.Drawing.Point(274, 329);
            this.btnUpdate.Name = "btnUpdate";
            this.btnUpdate.Size = new System.Drawing.Size(340, 23);
            this.btnUpdate.TabIndex = 31;
            this.btnUpdate.Text = "Update";
            this.btnUpdate.UseVisualStyleBackColor = true;
            this.btnUpdate.Click += new System.EventHandler(this.btnUpdate_Click);
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(202, 91);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(72, 13);
            this.label3.TabIndex = 30;
            this.label3.Text = "Page Content";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(202, 69);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(59, 13);
            this.label2.TabIndex = 29;
            this.label2.Text = "Page Type";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(202, 19);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(55, 13);
            this.label1.TabIndex = 28;
            this.label1.Text = "Page Title";
            // 
            // txtContent
            // 
            this.txtContent.Location = new System.Drawing.Point(274, 88);
            this.txtContent.Multiline = true;
            this.txtContent.Name = "txtContent";
            this.txtContent.ScrollBars = System.Windows.Forms.ScrollBars.Both;
            this.txtContent.Size = new System.Drawing.Size(340, 234);
            this.txtContent.TabIndex = 27;
            // 
            // txtPageType
            // 
            this.txtPageType.Location = new System.Drawing.Point(274, 62);
            this.txtPageType.Name = "txtPageType";
            this.txtPageType.Size = new System.Drawing.Size(70, 20);
            this.txtPageType.TabIndex = 26;
            // 
            // txtTitle
            // 
            this.txtTitle.Location = new System.Drawing.Point(274, 13);
            this.txtTitle.Name = "txtTitle";
            this.txtTitle.Size = new System.Drawing.Size(215, 20);
            this.txtTitle.TabIndex = 25;
            // 
            // lsvPages
            // 
            this.lsvPages.Columns.AddRange(new System.Windows.Forms.ColumnHeader[] {
            this.columnHeader1});
            this.lsvPages.ContextMenuStrip = this.contextMenuStrip1;
            this.lsvPages.GridLines = true;
            this.lsvPages.Location = new System.Drawing.Point(3, 3);
            this.lsvPages.MultiSelect = false;
            this.lsvPages.Name = "lsvPages";
            this.lsvPages.Size = new System.Drawing.Size(193, 296);
            this.lsvPages.TabIndex = 24;
            this.lsvPages.UseCompatibleStateImageBehavior = false;
            this.lsvPages.View = System.Windows.Forms.View.Details;
            this.lsvPages.MouseDoubleClick += new System.Windows.Forms.MouseEventHandler(this.lsvPages_MouseDoubleClick);
            // 
            // columnHeader1
            // 
            this.columnHeader1.Text = "Select Page";
            this.columnHeader1.Width = 259;
            // 
            // contextMenuStrip1
            // 
            this.contextMenuStrip1.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.deletePageToolStripMenuItem,
            this.reloadListToolStripMenuItem});
            this.contextMenuStrip1.Name = "contextMenuStrip1";
            this.contextMenuStrip1.Size = new System.Drawing.Size(137, 48);
            // 
            // deletePageToolStripMenuItem
            // 
            this.deletePageToolStripMenuItem.Name = "deletePageToolStripMenuItem";
            this.deletePageToolStripMenuItem.Size = new System.Drawing.Size(152, 22);
            this.deletePageToolStripMenuItem.Text = "Delete Page";
            this.deletePageToolStripMenuItem.Click += new System.EventHandler(this.deletePageToolStripMenuItem_Click);
            // 
            // reloadListToolStripMenuItem
            // 
            this.reloadListToolStripMenuItem.Name = "reloadListToolStripMenuItem";
            this.reloadListToolStripMenuItem.Size = new System.Drawing.Size(152, 22);
            this.reloadListToolStripMenuItem.Text = "Reload List";
            this.reloadListToolStripMenuItem.Click += new System.EventHandler(this.reloadListToolStripMenuItem_Click);
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(202, 44);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(50, 13);
            this.label4.TabIndex = 35;
            this.label4.Text = "Link Title";
            // 
            // txtLinkTitle
            // 
            this.txtLinkTitle.Location = new System.Drawing.Point(274, 38);
            this.txtLinkTitle.Name = "txtLinkTitle";
            this.txtLinkTitle.Size = new System.Drawing.Size(215, 20);
            this.txtLinkTitle.TabIndex = 34;
            // 
            // frmPages
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(618, 491);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.txtLinkTitle);
            this.Controls.Add(this.btnReset);
            this.Controls.Add(this.btnAdd);
            this.Controls.Add(this.btnUpdate);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.txtContent);
            this.Controls.Add(this.txtPageType);
            this.Controls.Add(this.txtTitle);
            this.Controls.Add(this.lsvPages);
            this.Name = "frmPages";
            this.Text = "Web Page Editor";
            this.FormClosed += new System.Windows.Forms.FormClosedEventHandler(this.frmPages_FormClosed);
            this.Load += new System.EventHandler(this.frmPages_Load);
            this.contextMenuStrip1.ResumeLayout(false);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button btnReset;
        private System.Windows.Forms.Button btnAdd;
        private System.Windows.Forms.Button btnUpdate;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox txtContent;
        private System.Windows.Forms.TextBox txtPageType;
        private System.Windows.Forms.TextBox txtTitle;
        private System.Windows.Forms.ListView lsvPages;
        private System.Windows.Forms.ColumnHeader columnHeader1;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.TextBox txtLinkTitle;
        private System.Windows.Forms.ContextMenuStrip contextMenuStrip1;
        private System.Windows.Forms.ToolStripMenuItem deletePageToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem reloadListToolStripMenuItem;
    }
}