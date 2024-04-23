import time
import pyautogui
import selenium
import openpyxl
from selenium import webdriver
from selenium.webdriver.common.by import By

driver = webdriver.Chrome()
driver.maximize_window()
driver.get("http://localhost/CRD/cadastro.php")

dadosDaPlanilha = openpyxl.load_workbook('testeDouglas.xlsx')
planilha = dadosDaPlanilha['teste']

x = 1
for daods in  planilha:
   
    nome = planilha['A' + str(x)].value
    idade = planilha['B' + str(x)].value
    cpf = planilha['C' + str(x)].value
    x += 1
    print(x)


    driver.find_element(By.ID,"nome").send_keys(nome)
    time.sleep(3)

    driver.find_element(By.ID,"idade").send_keys(idade)
    time.sleep(3)

    driver.find_element(By.ID,"cpf").send_keys(cpf)
    time.sleep(3)
    driver.find_element(By.ID,"btn-form").click()

