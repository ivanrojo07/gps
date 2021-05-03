def espiral(n):
	contador = n*n
	m = []
	numero = 1
	inicio = 0
	nlimite = n
	c = 1
	for x in range(0,n):
		row = []
		for y in range(0,n):
			row.insert(y,None)
			numero +=1
		m.insert(x,row) 
	while(c<=contador):
		# ciclo izquierda-derecha
		for i in range(inicio,nlimite):
			m[inicio][i] = c
			c+=1
		for x in range(inicio+1,nlimite):
			m[x][nlimite-1] = c
			c+=1
		for y in reversed(range(inicio,nlimite-1)):
			m[nlimite-1][y] = c
			c+=1
		for z in reversed(range(inicio+1,nlimite-1)):
			m[z][inicio]= c
			c+=1
		inicio = inicio+1
		nlimite = nlimite-1
	for x in range(0,n):
		print(m[x])

print(espiral(25))