args <- commandArgs(trailingOnly = TRUE)

if (length(args) < 2) {
  stop("Need input TSV file and output PNG file.")
}

input_file <- args[1]
output_file <- args[2]

df <- read.table(
  input_file,
  header = TRUE,
  sep = "\t",
  stringsAsFactors = FALSE,
  check.names = FALSE
)

png(output_file, width = 1100, height = 650)
par(mar = c(9, 5, 4, 2))

if (nrow(df) == 0) {
  plot.new()
  text(0.5, 0.5, "No expression data available", cex = 1.5)
  dev.off()
  quit(save = "no")
}

labels <- paste(df$sample_name, df$condition_name, sep = "\n")
values <- df$expression_value
unit_label <- unique(df$expression_unit)
unit_label <- if (length(unit_label) > 0 && unit_label[1] != "") unit_label[1] else "Expression Value"

barplot(
  height = values,
  names.arg = labels,
  las = 2,
  main = paste("Expression Plot:", unique(df$gene_symbol)),
  ylab = unit_label,
  col = "#5b8def",
  border = "#3157a6",
  cex.names = 0.9
)

grid(nx = NA, ny = NULL, col = "#e5e7eb")
dev.off()
