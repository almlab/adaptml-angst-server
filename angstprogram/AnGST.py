#!/usr/bin/python
# AnGST

# python libraries
import sys
import time
import pdb
import PyVM

from AnGSTHelper import RunAnGST
from AnGSTInput import input_obj

# initiate variable for measuring running time and memory consumtion
start_time = time.time()
mem_str = []
mem_str.append(PyVM.MemoryUpdate("init",'return'))

# load inputs #
print "* read input"
input_info = input_obj(sys.argv[1])
input_dict = {}
input_dict['input_info'] = input_info
input_dict['mem_str'] = mem_str
input_dict['write_out'] = False
angst_inputs = [input_dict]

# run angst one more time at that scaling
input_dict['write_out'] = True
input_dict['start_time'] = start_time
RunAnGST(input_dict)

#######CHANGED FOR THE ANGST SERVER######
# Run iTOL API and Upload species and gene trees
sys.path.append('/home/albertyw/itol/')
import Itol
import os
species_tree_location = input_info.species_tree_filename
itol_species_tree = Itol.Itol()
itol_species_tree.add_variable('treeFile',species_tree_location)
itol_species_tree.upload()
species_tree_webpage = itol_species_tree.get_webpage()

gene_tree_location = input_info.boots_file
itol_gene_tree = Itol.Itol()
itol_gene_tree.add_variable('treeFile',gene_tree_location)
itol_gene_tree.upload()
gene_tree_webpage = itol_gene_tree.get_webpage()

itol_file_location = os.path.dirname(input_info.species_tree_filename)+'/itol'
itol_file = open(itol_file_location,'w')
itol_file.write(species_tree_webpage+"\n"+gene_tree_webpage)
itol_file.close()
